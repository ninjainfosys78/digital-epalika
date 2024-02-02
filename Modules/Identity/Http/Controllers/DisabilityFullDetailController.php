<?php

namespace Modules\Identity\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Occupation;
use App\Traits\NepaliDateConverter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Modules\Identity\Entities\DisabilityIdentityCard;
use Modules\Identity\Entities\DisabilityReason;
use Modules\Identity\Http\Requests\UpdateDisabilityFullDetailResource;

class DisabilityFullDetailController extends Controller
{
    use NepaliDateConverter;

    public function index()
    {
        $disabilityIdentityCards = DisabilityIdentityCard::with('disabilityType')
            ->where(function ($q) {
                if (!is_null(request('search'))) {
                    $q->whereLike([
                        'name',
                        'name_en',
                        'citizenship_no',
                        'birth_registration_no',
                        'guardian_name',
                        'guardian_name_en',
                        'phone'
                    ], request('search'));
                }
            })
            ->where('status', StatusEnum::APPROVE->value)
            ->latest()
            ->paginate(10);

        return view('identity::admin.disabilityFullDetail.index', compact('disabilityIdentityCards'));
    }


    public function show(DisabilityIdentityCard $disabilityIdentityCard)
    {
        return view('identity::admin.disabilityFullDetail.show', compact('disabilityIdentityCard'));
    }

    public function edit(DisabilityIdentityCard $disabilityIdentityCard)
    {
        $todayDateInBS = $this->get_today_nepali_date();
        $disabilityReasons = DisabilityReason::all();
        $occupations = Occupation::all();
        return view('identity::admin.disabilityFullDetail.edit', compact('disabilityIdentityCard', 'disabilityReasons', 'occupations', 'todayDateInBS'));
    }

    public function update(UpdateDisabilityFullDetailResource $request, DisabilityIdentityCard $disabilityIdentityCard)
    {
        if (empty($disabilityIdentityCard->number)) {
            $number = DisabilityIdentityCard::where('fiscal_year_id', officeSetting()->fiscal_year_id)->max('number') + 1;
        } else {
            $number = $disabilityIdentityCard->number;
        }
        if (empty($disabilityIdentityCard->card_no)) {
            $fiscalYear = officeSetting()->fiscalYear;
            $title = $fiscalYear ? $fiscalYear->title : 'default_value';
            $card_no = $title . '-' . Str::padLeft($number, 3, 0);
        } else {
            $card_no = $disabilityIdentityCard->card_no;
        }

        $disabilityIdentityCard->update($request->validated() + [
                'status' => StatusEnum::READY_FOR_PRINT->value,
                'number' => $number,
                'card_no' => $card_no,
            ]);

        toast('Disability Full Detail Updated Successfully', 'success');

        return redirect()->route('identity.admin.disabilityFullDetail.index');
    }
}
