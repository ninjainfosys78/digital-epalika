<?php

namespace Modules\GrievanceHandling\Http\Controllers\Admin;

use App\Models\Settings\Branch;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\GrievanceHandling\Entities\GrievanceType;
use Modules\GrievanceHandling\Enums\GrievanceComplaintSeverity;
use Modules\GrievanceHandling\Enums\GrievanceMediumEnum;
use Modules\GrievanceHandling\Http\Requests\Api\StoreGrievanceRequest;
use Modules\GrievanceHandling\Transformers\Api\GrievanceResource;

class GrievanceApiFormController extends Controller
{
    public function grievanceFormSetting()
    {
        return [
            'grievanceTypes' => GrievanceType::selectRaw('id,title')->get(),
            'branches' => Branch::selectRaw('id,branch_name')->get(),
            'grievanceSeverity' => GrievanceComplaintSeverity::getValuesWithLabels(),
        ];
    }

    public function grievance(StoreGrievanceRequest $request)
    {
        DB::transaction(function () use ($request) {

            $grievanceDetail = auth()->user()?->grievanceDetails()?->create($request->validated() + [
                    'token' => time(),
                    'grievance_medium' => GrievanceMediumEnum::SYSTEM,
                    'assigned_user_id' => $grievanceSetting->user_id ?? User::first()->id,
                    'assigned_at' => now()
                ]);
            if (!empty($request->validated()['files'])) {
                foreach ($request->validated()['files'] as $file) {
                    $grievanceDetail->files()->create([
                        'file_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                        'extension' => $file->getClientOriginalExtension(),
                        'file' => $file->store('grievance/files/' . Str::slug(auth()->user()?->name, '_'), 'public'),
                    ]);
                }
            }

            $grievanceDetail
                ->grievanceAssignHistories()
                ->create([
                    'user_id' => $grievanceDetail->assigned_user_id
                ]);

            return $grievanceDetail;
        });


        return response()->json([
            'message' => 'Grievance Stored Successfully'
        ]);
    }

    public function getMobileUserGrievance()
    {
        return GrievanceResource::collection(auth()->user()?->load(['grievanceDetails.grievanceType', 'grievanceDetails.branch'])?->grievanceDetails);
    }
}
