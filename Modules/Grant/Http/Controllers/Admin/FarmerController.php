<?php

namespace Modules\Grant\Http\Controllers\Admin;

use App\Enums\MaritalStatusEnum;
use App\Models\Settings\Relationship;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Modules\Grant\Entities\Cooperative;
use Modules\Grant\Entities\CooperativeType;
use Modules\Grant\Entities\Enterprise;
use Modules\Grant\Entities\EnterpriseType;
use Modules\Grant\Entities\Farmer;
use Modules\Grant\Entities\GrantProgram;
use Modules\Grant\Entities\Group;
use Modules\Grant\Http\Requests\Farmer\StoreFarmerRequest;
use Modules\Grant\Http\Requests\Farmer\UpdateFarmerRequest;

class FarmerController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('farmer_access');


        $families = collect();
        $farmers = Farmer::with('province', 'district', 'localBody', 'grantDetails.localBody')
            ->where(function (Builder $q) {
                if (!is_null(request('search'))) {
                    $q->whereLike(['unique_id', 'first_name', 'citizenship_no', 'farmer_id_card_no', 'national_id_card_no', 'phone_no'], request('search'));
                }
                if (!auth()->user()?->load('role')?->role?->type == 'Super') {
                    $q->where('user_id', auth()->id());
                }
            })
            ->latest()
            ->paginate(10);

        return view('grant::admin.farmer.index', compact('farmers'));
    }

    public function create()
    {
        $this->checkAuthorization('farmer_create');

        $cooperatives = Cooperative::latest()->get();
        $groups = Group::latest()->get();
        $enterprises = Enterprise::latest()->get();
        $cooperativeTypes = CooperativeType::all();
        $enterpriseTypes = EnterpriseType::all();
        $relationships = Relationship::get();
        $countrymen = Farmer::whereNull('farmer_id')->latest()->get();

        return view('grant::admin.farmer.create', compact('cooperatives', 'groups', 'enterprises', 'cooperativeTypes', 'enterpriseTypes', 'relationships', 'countrymen'));
    }

    public function store(StoreFarmerRequest $request)
    {
        $this->checkAuthorization('farmer_create');

        $farmer = DB::transaction(function () use ($request) {
            $farmer = Farmer::create($request->validated());

            $farmer->groups()->attach($request->input('groups'));
            $farmer->enterprises()->attach($request->input('enterprises'));
            $farmer->cooperatives()->attach($request->input('cooperatives'));
            return $farmer;
        });
        if ($request->ajax()) {
            return response()->json([
                'data' => [
                    'farmer_id' => $farmer->id,
                    'farmer_name' => $farmer->name
                ],
                'message' => 'कृषक सफलता पुर्वक थपियो !'
            ]);
        }

        toast('कृषक सफलता पुर्वक थपियो !', 'success');
        return back();
    }

    public function show(Farmer $farmer)
    {
        $this->checkAuthorization('farmer_access');

        $farmer
            ->load('province', 'district', 'localBody', 'grantDetails.localBody', 'farmers.relationship', 'farmers.grantDetails', 'farmer', 'farmer.grantDetails', 'relationship');
        $grantPrograms = GrantProgram::all();

        $families = collect();

        if ($farmer->farmer) {
            $families->push($farmer->farmer);
        }

        if ($farmer->farmers) {
            $families = $families->concat($farmer->farmers);
        }


        return view('grant::admin.farmer.show', compact('farmer', 'grantPrograms', 'families'));
    }

    public function edit(Farmer $farmer)
    {
        $this->checkAuthorization('farmer_edit');

        $farmer->load('cooperatives', 'groups', 'enterprises');

        $cooperatives = Cooperative::latest()->get();
        $groups = Group::latest()->get();
        $enterprises = Enterprise::latest()->get();
        $cooperativeTypes = CooperativeType::all();
        $enterpriseTypes = EnterpriseType::all();
        $relationships = Relationship::get();
        $countrymen = Farmer::whereNull('farmer_id')->latest()->get();
        return view('grant::admin.farmer.edit', compact('countrymen', 'relationships', 'farmer', 'cooperatives', 'groups', 'enterprises', 'cooperativeTypes', 'enterpriseTypes'));
    }

    public function update(UpdateFarmerRequest $request, Farmer $farmer): Redirector|Application|RedirectResponse
    {
        $this->checkAuthorization('farmer_edit');

        DB::transaction(function () use ($request, $farmer) {
            if ($request->hasFile('photo') && $farmer->photo) {
                $this->deleteFile($farmer->photo);
            }
            $farmer->update($request->validated());
            if ($farmer->marital_status == MaritalStatusEnum::UNMARRIED) {
                $farmer->update(['spouse_name' => null]);
            }

            $farmer->groups()->sync($request->input('groups'));
            $farmer->enterprises()->sync($request->input('enterprises'));
            $farmer->cooperatives()->sync($request->input('cooperatives'));
        });
        toast('कृषक सफलता पुर्वक सम्पादन गरियो ', 'success');
        return redirect(route('admin.grant.farmer.index'));
    }

    public function destroy(Farmer $farmer): RedirectResponse
    {
        $this->checkAuthorization('farmer_delete');

        $farmer->groups()->detach();
        $farmer->enterprises()->detach();
        $farmer->cooperatives()->detach();

        if ($farmer->photo) {
            $this->deleteFile($farmer->photo);
        }
        $farmer->delete();

        toast('कृषक सफलता पुर्वक हटाईयो !', 'success');

        return back();
    }

    public function grantDetails(Farmer $farmer)
    {
        $this->checkAuthorization('farmer_access');

        $farmer->load('grantDetails.grant.grantProgram');


        return view('grant::admin.farmer.grant_details', compact('farmer'));
    }
}
