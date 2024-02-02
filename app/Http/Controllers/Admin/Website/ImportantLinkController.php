<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\ImportantLink\StoreImportantLinkRequest;
use App\Http\Requests\Website\ImportantLink\UpdateImportantLinkRequest;
use App\Models\Website\ImportantLink;

class ImportantLinkController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('importantLink_access');
        $importantLinks = ImportantLink::all();

        return view('admin.website.important_link.index', compact('importantLinks'));
    }

    public function create()
    {
        $this->checkAuthorization('importantLink_create');
        return view('admin.website.important_link.create');
    }

    public function store(StoreImportantLinkRequest $request)
    {
        $this->checkAuthorization('importantLink_create');
        ImportantLink::create($request->validated());

        toast('महत्त्वपूर्ण लिङ्क सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(ImportantLink $importantLink)
    {
        //
    }

    public function edit(ImportantLink $importantLink)
    {
        $this->checkAuthorization('importantLink_edit');
        return view('admin.website.important_link.edit', compact('importantLink'));
    }

    public function update(UpdateImportantLinkRequest $request, ImportantLink $importantLink)
    {
        $this->checkAuthorization('importantLink_edit');
        $importantLink->update($request->validated());

        toast('महत्त्वपूर्ण लिङ्क सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.global.website.importantLink.index'));
    }

    public function destroy(ImportantLink $importantLink)
    {
        $this->checkAuthorization('importantLink_delete');
        $importantLink->delete();

        toast('महत्त्वपूर्ण लिङ्क सफलतापूर्वक मेटियो', 'success');

        return back();
    }
}
