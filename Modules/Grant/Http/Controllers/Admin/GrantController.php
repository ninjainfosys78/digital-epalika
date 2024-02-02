<?php

namespace Modules\Grant\Http\Controllers\Admin;

use App\Models\Settings\Branch;
use App\Models\Settings\FiscalYear;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Modules\Grant\Entities\Grant;
use Modules\Grant\Entities\GrantOffice;
use Modules\Grant\Entities\GrantType;
use Modules\Grant\Http\Requests\Grant\StoreGrantRequest;
use Modules\Grant\Http\Requests\Grant\UpdateGrantRequest;

use Illuminate\Database\Eloquent\Builder;

class GrantController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('grant_access');

        $grants = Grant::with('fiscalYear', 'grantType', 'branch', 'grantOffice')->where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['fiscalYear', 'grantOffice', 'grantType',], request('search'));
            }

            if (!is_null(auth()->user()->branch_id)) {
                $q->where('branch_id', auth()->user()->branch_id);
            }
        })
            ->latest()
            ->paginate(10);

        return view('grant::admin.grant.index', compact('grants'));
    }

    public function create()
    {
        $this->checkAuthorization('grant_create');

        $fiscalYears = FiscalYear::all();
        $grantTypes = GrantType::all();
        $grantOffices = GrantOffice::all();
        $branches = Branch::with('branches')->whereNull('branch_id')->get();

        return view('grant::admin.grant.create', compact('fiscalYears', 'grantTypes', 'grantOffices', 'branches'));
    }

    public function store(StoreGrantRequest $request)
    {
        $this->checkAuthorization('grant_create');

        Grant::create($request->validated() + [
                'user_id' => auth()->id()
            ]);

        toast('अनुदान कार्यक्रम सफलता पुर्बक थपियो', 'success');
        return back();
    }

    public function show(Grant $grant)
    {
        $this->checkAuthorization('grant_access');

        $grant->load('grantDetails.model');

        return view('grant::admin.grant.show', compact('grant'));
    }

    public function edit(Grant $grant): Factory|View|\Illuminate\Contracts\Foundation\Application
    {
        $this->checkAuthorization('grant_edit');

        $fiscalYears = FiscalYear::all();
        $grantTypes = GrantType::all();
        $grantOffices = GrantOffice::all();
        $branches = Branch::with('branches')->whereNull('branch_id')->get();

        return view('grant::admin.grant.edit', compact('grant', 'fiscalYears', 'grantTypes', 'grantOffices', 'branches'));
    }

    public function update(UpdateGrantRequest $request, Grant $grant)
    {
        $this->checkAuthorization('grant_edit');
        $grant->update($request->validated());
        toast('अनुदान सफलता पुर्वक सम्पादन गरियो', 'success');
        return redirect(route('admin.grant.grant.index'));
    }

    public function destroy(Grant $grant)
    {
        $grant->delete();

        toast('अनुदान सफलता पुर्वक हटाईयो !', 'success');

        return back();
    }

    public function grantDetails(Grant $grant)
    {
        $this->checkAuthorization('grant_access');

        $grant->load('grantDetails.model');

        return view('grant::admin.grant.grant_details', compact('grant'));
    }
}
