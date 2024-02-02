<?php

namespace Modules\Identity\Http\Controllers;

use App\Enums\StatusEnum;
use App\Traits\NepaliDateConverter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ethnicity;
use App\Models\Occupation;
use App\Models\Settings\Relationship;




use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Modules\Identity\Entities\DisabilityCommittee;
use Modules\Identity\Entities\DisabilityIdentityCard;
use Modules\Identity\Entities\DisabilityReason;
use Modules\Identity\Entities\DisabilityType;


use Modules\Identity\Entities\EmployeeSignature;
use Modules\Identity\Entities\GovernmentalDisabilityType;
use Modules\Identity\Entities\IdentityMeeting;
use Modules\Identity\Http\Requests\IdentityPrint\UpdateIdentityPrintRequest;
use Illuminate\Support\Str;

class IdentityPrintController extends Controller
{
    use NepaliDateConverter;
    public function print()
    {

        $governmentalDisabilityTypes = GovernmentalDisabilityType::with(['disabilityIdentityCards' => function ($query) {
            $query->where('status', StatusEnum::READY_FOR_PRINT->value);
        }])
            ->get();
        $employeeSignatures = EmployeeSignature::all();
        return view('identity::admin.disabilityPrint.index', compact('governmentalDisabilityTypes', 'employeeSignatures'));
    }




    public function printCard(DisabilityIdentityCard $disabilityIdentityCard)
    {
        $view = DB::transaction(function () use ($disabilityIdentityCard) {
            $disabilityIdentityCard->update([
                'print_count' => $disabilityIdentityCard->print_count + 1
            ]);
            $disabilityIdentityCard->load(
                'governmentalDisabilityType',
                'province',
                'localBody',
                'district',
                'disabilityType',
                'employeeSignature'
            );
            $date = $this->get_today_nepali_date();
            return (string) View::make('identity::admin.disabilityPrint.idCard', compact('disabilityIdentityCard', 'date'));
        });

        return response()->json([
            'view' => $view,
        ]);
    }





    public function updateSign(Request $request, DisabilityIdentityCard $disabilityIdentityCard)
    {
        $request->validate([
            'employee_signature_id' => 'required'
        ]);

        $view = DB::transaction(function () use ($disabilityIdentityCard, $request) {
            $oldPrintDate = $disabilityIdentityCard->latest_print_at?->toDateString();
            $disabilityIdentityCard->update([
                'latest_print_at' => now(),
                'first_print_at' => !empty($disabilityIdentityCard->first_print_at) ? $disabilityIdentityCard->first_print_at : now(),
                'print_count' => $disabilityIdentityCard->print_count + 1,
                'employee_signature_id' => $request->input('employee_signature_id')
            ]);
            $disabilityIdentityCard->load(
                'governmentalDisabilityType',
                'province',
                'localBody',
                'district',
                'disabilityType',
                'employeeSignature'
            );

            if($disabilityIdentityCard->print_count > 1) {
                $oldDateArray = explode('-', $oldPrintDate);
                $oldNepaliDate = $this->get_nepali_date($oldDateArray[0], $oldDateArray[1], $oldDateArray[2]);
                $oldFormattedNepaliDate = Str::padLeft($oldNepaliDate['y'], 4, 0)."-".Str::padLeft($oldNepaliDate['m'], 2, 0)."-".Str::padLeft($oldNepaliDate['d'], 2, 0);

                $disabilityIdentityCard->identityRecords()->create([
                    'print_date' => $this->get_today_nepali_date(),
                    'print_date_en' => today()->toDateString(),
                    'old_print_date' => $oldFormattedNepaliDate,
                    'old_print_date_en' =>  $oldPrintDate
                ]);
            }
            $date = $this->get_today_nepali_date();
            return (string)View::make('identity::admin.disabilityPrint.idCard', compact('disabilityIdentityCard', 'date'));
        });
        return response()->json([
            'view' => $view,
        ]);
    }

    public function edit(DisabilityIdentityCard $disabilityIdentityCard)
    {
        $this->authorize('update', $disabilityIdentityCard);
        $officeSetting = officeSetting();
        $ethnicities = Ethnicity::all();
        $relations = Relationship::all();
        $disabilityTypes = DisabilityType::all();
        $todayDateInBS = $this->get_today_nepali_date();
        $disabilityReasons = DisabilityReason::all();
        $occupations = Occupation::all();
        $identityMeetings = IdentityMeeting::all();
        $disabilityCommittees = DisabilityCommittee::all();
        $governmentDisabilityTypes = GovernmentalDisabilityType::all();
        return view('identity::admin.disabilityPrint.edit', compact('disabilityIdentityCard', 'ethnicities', 'relations', 'disabilityTypes', 'officeSetting', 'disabilityReasons', 'occupations', 'identityMeetings', 'disabilityCommittees', 'governmentDisabilityTypes', 'todayDateInBS'));
    }

    public function update(UpdateIdentityPrintRequest $request, DisabilityIdentityCard $disabilityIdentityCard)
    {
        $this->authorize('update', $disabilityIdentityCard);
        $disabilityIdentityCard->update($request->validated());
        toast('अपाङ्गता परिचय पत्र सफलतापुर्बक अपडेट भयो', 'success');
        return redirect(route('identity.admin.identityPrint'));
    }
}
