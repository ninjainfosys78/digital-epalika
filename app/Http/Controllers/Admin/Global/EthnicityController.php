<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Ethnicity\StoreEthnicityRequest;
use App\Http\Requests\Setting\Ethnicity\UpdateEthnicityRequest;
use App\Models\Ethnicity;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EthnicityController extends Controller
{
    public function index(): Factory|View|Application
    {
        $this->checkAuthorization('ethnicity_access');

        $ethnicities = Ethnicity::get();

        return view('admin.global.ethnicity.index', compact('ethnicities'));
    }

    public function create()
    {
        $this->checkAuthorization('ethnicity_create');

        return view('admin.global.ethnicity.create');
    }

    public function store(StoreEthnicityRequest $request): RedirectResponse
    {
        $this->checkAuthorization('ethnicity_create');

        Ethnicity::create($request->validated());
        toast('जातीयता सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(Ethnicity $ethnicity)
    {
    }

    public function edit(Ethnicity $ethnicity)
    {
        $this->checkAuthorization('ethnicity_edit');

        return view('admin.global.ethnicity.edit', compact('ethnicity'));
    }

    public function update(UpdateEthnicityRequest $request, Ethnicity $ethnicity)
    {
        $this->checkAuthorization('ethnicity_edit');

        $ethnicity->update($request->validated());
        toast('जातीयता सफलतापूर्वक अपडेट गरियो', 'success');

        return redirect(route('admin.global.generalSetting.ethnicity.index'));
    }

    public function destroy(Ethnicity $ethnicity)
    {
        $this->checkAuthorization('ethnicity_delete');

        $ethnicity->delete();
        toast('जातीयता सफलतापूर्वक मेटाइयो', 'success');

        return back();
    }
}
