<?php

namespace Modules\Grant\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Modules\Grant\Entities\Affiliation;
use Modules\Grant\Http\Requests\Setting\Affiliation\StoreAffiliationRequest;
use Modules\Grant\Http\Requests\Setting\Affiliation\UpdateAffiliationRequest;

class AffiliationController extends Controller
{
    public function index(): Factory|View|Application
    {
        $this->checkAuthorization('affiliation_access');
        $affiliations = Affiliation::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['name'], request('search'));
            }
        })->latest()->paginate(10);
        return view('grant::admin.setting.affiliation.index', compact('affiliations'));
    }

    public function create()
    {
        $this->checkAuthorization('affiliation_create');

        return view('grant::admin.setting.affiliation.create');
    }

    public function store(StoreAffiliationRequest $request): RedirectResponse
    {
        $this->checkAuthorization('affiliation_create');

        Affiliation::create($request->validated());
        toast('सहकारी आव्धता सफलता पुर्वक थपियो', 'success');
        return back();
    }

    public function edit(Affiliation $affiliation)
    {
        $this->checkAuthorization('affiliation_edit');


        return view('grant::admin.setting.affiliation.edit', compact('affiliation'));
    }

    public function update(UpdateAffiliationRequest $request, Affiliation $affiliation): Redirector|Application|RedirectResponse
    {
        $this->checkAuthorization('affiliation_edit');

        $affiliation->update($request->validated());
        toast('सहकारी आव्धता सफलता पुर्वक सम्पादन गरियो', 'success');
        return redirect(route('admin.grant.setting.affiliation.index'));
    }

    public function destroy(Affiliation $affiliation): RedirectResponse
    {
        $this->checkAuthorization('affiliation_delete');
        $affiliation->delete();
        toast('सहकारी आव्धता सफलता पुर्वक हटाइयो', 'success');
        return back();
    }
}
