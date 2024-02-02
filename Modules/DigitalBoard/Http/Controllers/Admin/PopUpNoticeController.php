<?php

namespace Modules\DigitalBoard\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings\OfficeSetting;
use Illuminate\Http\RedirectResponse;
use Modules\DigitalBoard\Entities\PopUpNotice;
use Illuminate\Support\Str;
use Modules\DigitalBoard\Http\Requests\PopUpNotice\StorePopUpNoticeRequest;
use Modules\DigitalBoard\Http\Requests\PopUpNotice\UpdatePopUpNoticeRequest;
use Illuminate\Support\Facades\DB;

class PopUpNoticeController extends Controller
{
    public function index()
    {
        $popUpNotices = PopUpNotice::latest()->paginate(10);


        return view('digitalboard::admin.popUpNotice.index', compact('popUpNotices'));
    }

    public function create()
    {
        return view('digitalboard::admin.popUpNotice.create');
    }

    public function store(StorePopUpNoticeRequest $request)
    {
        $this->checkAuthorization('digitalBoardNotice_create');
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'date' => ['required'],
            'description' => ['nullable'],
            'closed_at' => ['nullable'],
            'show_on_index' => ['nullable', 'boolean'],
            'files' => ['array', 'nullable'],
            'files.*' => ['mimes:png,jpeg,jpg'],
        ]);

        DB::transaction(function () use ($request, $data) {
            $officeSetting = OfficeSetting::first();
            $popUpNotice = PopUpNotice::create($data + [
                'user_id' => auth()->id(),
                'fiscal_year_id' => $officeSetting->fiscal_year_id ?? null,
            ]);

            if ($request->hasFile('files')) {
                $this->fileUpload($popUpNotice, $request);
            }
        });


        toast('नयाँ Pop Up थपियो', 'success');
        return back();
    }

    public function show(PopUpNotice $popUpNotice)
    {
        $this->checkAuthorization('digitalBoardNotice_access');

        $popUpNotice->load('files');

        return view('digitalboard::admin.popUpNotice.show', compact('popUpNotice'));
    }
    public function edit(PopUpNotice $popUpNotice)
    {
        $this->checkAuthorization('digitalBoardNotice_edit');

        return view('digitalboard::admin.popUpNotice.edit', compact('popUpNotice'));
    }

    public function update(UpdatePopUpNoticeRequest $request, PopUpNotice $popUpNotice)
    {
        $this->checkAuthorization('digitalBoardNotice_edit');

        $popUpNotice->update($request->validated());
        if ($request->hasFile('files')) {
            $this->fileUpload($popUpNotice, $request);
        }

        toast('Pop Up अद्यावधिक गरियो', 'success');

        return redirect(route('admin.digitalBoard.popUpNotice.index'));
    }

    public function destroy(PopUpNotice $popUpNotice)
    {
        $this->checkAuthorization('digitalBoardNotice_delete');

        foreach ($popUpNotice->files as $file) {
            $this->deleteFile($file->file);
        }
        $popUpNotice->files()->delete();
        $popUpNotice->delete();

        toast(' Pop Up सफलतापूर्वक मेटियो', 'success');

        return back();
    }

    public function updateShowOnIndex(PopUpNotice $popUpNotice): RedirectResponse
    {
        $popUpNotice->update([
            'show_on_index' => !$popUpNotice->show_on_index,
        ]);
        toast('स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }

    public function fileUpload($popUpNotice, $request): void
    {
        foreach ($request->file('files') as $file) {
            $extension = $file->getClientOriginalExtension();
            $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $popUpNotice->files()->create([
                'file_name' => $name,
                'extension' => $extension,
                'file' => $file->store('popUpNotice/' . Str::slug($request->input('title'), '_'), 'public'),
            ]);
        }
    }
}
