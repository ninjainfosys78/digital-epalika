<?php

namespace Modules\EMap\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address\District;
use App\Models\File;
use Illuminate\Support\Facades\DB;
use Modules\EMap\Entities\HouseOwner;
use Modules\EMap\Entities\HouseOwnerArchive;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Http\Requests\HouseOwnerArchive\StoreHouseOwnerArchiveRequest;
use Modules\EMap\Http\Requests\HouseOwnerArchive\UpdateHouseOwnerArchiveRequest;

class HouseOwnerArchiveController extends Controller
{
    public function index(MapApply $mapApply)
    {
        $allDistricts = District::all();
        $houseOwnerArchives = HouseOwnerArchive::latest()->where('map_apply_id', $mapApply->id)->get();
        return view('emap::admin.houseOwnerArchive.index', compact('mapApply', 'allDistricts', 'houseOwnerArchives'));
    }

    public function create(MapApply $mapApply)
    {
        return view('emap::create');
    }

    public function store(StoreHouseOwnerArchiveRequest $request, MapApply $mapApply)
    {
        $houseOwner = HouseOwner::where('map_apply_id', $mapApply->id)->first();
        DB::transaction(function () use ($houseOwner, $request, $mapApply) {
            $houseOwnerArchive =  HouseOwnerArchive::create([
                'map_apply_id' => $mapApply->id,
                'name' => $houseOwner->name,
                'phone' => $houseOwner->phone,
                'father_name' => $houseOwner->father_name,
                'grandfather_name' => $houseOwner->grandfather_name,
                'citizenship_issue_district_id' => $houseOwner->citizenship_issue_district_id,
                'citizenship_no' => $houseOwner->citizenship_no,
                'citizenship_issue_date' => $houseOwner->citizenship_issue_date,
                'address' => $houseOwner->address,
                'local_body' => $houseOwner->local_body,
                'ward_no' => $houseOwner->ward_no,
            ]);

            $houseOwnerFiles = File::where('model_type', HouseOwner::class)
                ->where('model_id', $houseOwner->id)
                ->get();

            if ($houseOwnerFiles->isNotEmpty()) {
                foreach ($houseOwnerFiles as $houseOwnerFile) {
                    $houseOwnerFile->update([
                        'model_type' => HouseOwnerArchive::class,
                        'model_id' => $houseOwnerArchive->id
                    ]);
                }
            }
            $houseOwner->update([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'father_name' => $request->input('father_name'),
                'grandfather_name' => $request->input('grandfather_name'),
                'citizenship_issue_district_id' => $request->input('citizenship_issue_district_id'),
                'citizenship_no' => $request->input('citizenship_no'),
                'citizenship_issue_date' => $request->input('citizenship_issue_date'),
                'address' => $request->input('address'),
                'local_body' => $request->input('local_body'),
                'ward_no' => $request->input('ward_no'),
            ]);

            foreach ($request->validated()['files'] as $file) {
                $extension = $file['file']->getClientOriginalExtension();
                $houseOwner->files()->create([
                    'file_name' => $file['file_name'],
                    'extension' => $extension,
                    'file' => $file['file']->store('houseOwner', 'public'),
                ]);
            }
        });

        toast('New House Owner Updated Successfully', 'success');
        return back();
    }

    public function show(MapApply $mapApply, HouseOwnerArchive $houseOwnerArchive)
    {
        return view('emap::show');
    }

    public function edit(MapApply $mapApply, HouseOwnerArchive $houseOwnerArchive)
    {
        return view('emap::edit');
    }

    public function update(UpdateHouseOwnerArchiveRequest $request, MapApply $mapApply, HouseOwnerArchive $houseOwnerArchive)
    {
        //
    }

    public function destroy(MapApply $mapApply, HouseOwnerArchive $houseOwnerArchive)
    {
        //
    }
}
