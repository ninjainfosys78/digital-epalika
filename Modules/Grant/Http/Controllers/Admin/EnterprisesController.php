<?php

namespace Modules\Grant\Http\Controllers\Admin;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Modules\Grant\Entities\Enterprise;
use Modules\Grant\Entities\EnterpriseType;
use Modules\Grant\Entities\Farmer;
use Modules\Grant\Entities\GrantProgram;
use Modules\Grant\Http\Requests\Enterprises\StoreEnterprisesRequest;
use Modules\Grant\Http\Requests\Enterprises\UpdateEnterprisesRequest;

class EnterprisesController extends Controller
{
    public function index()
    {
        $enterprises = Enterprise::with('enterpriseType', 'province', 'district', 'localBody', 'grantDetails.localBody')
            ->where(function (Builder $q) {
                if (!is_null(request('search'))) {
                    $q->whereLike(['enterprise_type_id', 'name', 'vat_pan'], request('search'));
                }

                if (!auth()->user()?->load('role')?->role?->type == 'Super') {
                    $q->where('user_id', auth()->id());
                }
            })
            ->latest()
            ->paginate(10);


        return view('grant::admin.enterprise.index', compact('enterprises'));
    }



    public function create()
    {
        $this->checkAuthorization('enterprise_create');

        $farmers = Farmer::all();
        $enterpriseTypes = EnterpriseType::all();

        return view('grant::admin.enterprise.create', compact('farmers', 'enterpriseTypes'));
    }

    public function store(StoreEnterprisesRequest $request)
    {
        $this->checkAuthorization('enterprise_create');

        $enterprises = DB::transaction(function () use ($request) {
            $enterprise = Enterprise::create($request->validated());

            $enterprise->farmers()->attach($request->input('farmers'));

            return $enterprise;
        });

        if ($request->ajax()) {
            return response()->json([
                'data' => [
                    'enterprise_id' => $enterprises->id,
                    'enterprise_name' => $enterprises->name
                ],
                'message' => 'Enterprise Added successfully'
            ]);
        }

        toast('निजि उधम/फर्म सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit(Enterprise $enterprise): Factory|View|Application
    {
        $this->checkAuthorization('enterprise_edit');

        $enterprise->load('province', 'district', 'localBody');
        $enterpriseTypes = EnterpriseType::all();
        $farmers = Farmer::all();


        return view('grant::admin.enterprise.edit', compact('enterprise', 'enterpriseTypes', 'farmers'));
    }

    public function update(UpdateEnterprisesRequest  $request, Enterprise $enterprise): Redirector|Application|RedirectResponse
    {
        $this->checkAuthorization('enterprise_edit');

        $enterprise->update($request->validated());

        DB::transaction(function () use ($request, $enterprise) {
            $enterprise->update($request->validated());

            $enterprise->farmers()->sync($request->input('farmers'));
        });

        toast('निजि उधम/फर्म सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.grant.enterprise.index'));
    }

    public function destroy(Enterprise $enterprise)
    {
        $this->checkAuthorization('enterprise_delete');

        $enterprise->farmers()->detach();
        $enterprise->delete();

        toast('निजि उधम/फर्म सफलतापूर्वक मेटाइयो', 'success');
        return back();
    }

    public function show(Enterprise $enterprise)
    {
        $this->checkAuthorization('enterprise_access');

        $enterprise->load('province', 'district', 'localBody', 'enterpriseType', 'farmers', 'grantDetails.grant.grantProgram', 'grantDetails.localBody');
        $grantPrograms = GrantProgram::all();
        return view('grant::admin.enterprise.show', compact('enterprise', 'grantPrograms'));
    }
    public function grantDetails(Enterprise $enterprise)
    {
        $this->checkAuthorization('enterprise_access');

        $enterprise->load('province', 'district', 'localBody', 'enterpriseType', 'farmers', 'grantDetails.grant.grantProgram', 'grantDetails.localBody');
        return view('grant::admin.enterprise.grant_details', compact('enterprise'));
    }
}
