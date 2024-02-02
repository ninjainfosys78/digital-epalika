<?php

namespace Modules\Grant\Http\Controllers\Admin\Setting;

use Illuminate\Console\Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Modules\Grant\Entities\HelplessnessType;
use Modules\Grant\Http\Requests\Setting\HelplessnessType\StoreHelplessnessType;
use Modules\Grant\Http\Requests\Setting\HelplessnessType\UpdateHelplessnessType;

class HelplessnessTypeController extends Controller
{
    public function index()
    {
        $helplessnessTypes = HelplessnessType::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['name'], request('search'));
            }
        })->latest()->paginate(10);
        return view('grant::admin.setting.helplessnessType.index', compact('helplessnessTypes'));
    }

    public function create()
    {

        return view('grant::admin.setting.helplessnessType.create');
    }

    public function store(StoreHelplessnessType $request): RedirectResponse
    {
        HelplessnessType::create($request->validated());
        toast('असहायताको प्रकार सफलता पुर्वक थपियो', 'success');
        return back();
    }

    public function show($id)
    {
        return view('grant::show');
    }

    public function edit(HelplessnessType $helplessnessType)
    {
        return view('grant::admin.setting.helplessnessType.edit', compact('helplessnessType'));
    }

    public function update(UpdateHelplessnessType $request, HelplessnessType $helplessnessType): Redirector|Application|RedirectResponse
    {
        $helplessnessType->update($request->validated());
        toast('असहायताको प्रकार सफलता पुर्वक सम्पादन गरियो', 'success');
        return redirect(route('admin.grant.setting.helplessnessType.index'));
    }

    public function destroy(HelplessnessType $helplessnessType): RedirectResponse
    {
        $helplessnessType->delete();
        toast('असहायताको प्रकार सफलता पुर्वक हटाइयो', 'success');
        return back();
    }
}
