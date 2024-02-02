<?php

namespace Modules\Identity\Http\Controllers;

use App\Models\OfficeHeader;
use App\Traits\NepaliDateConverter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Modules\Identity\Entities\DisabilityIdentityCard;
use Modules\Identity\Entities\DisabilityPrint;

class DisabilityPrintController extends Controller
{
    use NepaliDateConverter;
    public function store(Request $request, DisabilityIdentityCard $disabilityIdentityCard)
    {
        $officeHeaders = OfficeHeader::get();
        $todayDate = $this->get_today_nepali_date();
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255']
        ]);
        $disabilityPrint =  DB::transaction(function () use ($officeHeaders, $todayDate, $data, $disabilityIdentityCard) {
            return DisabilityPrint::create($data + [
                    'disability_identity_card_id' => $disabilityIdentityCard->id,
                    'date' => $this->get_today_nepali_date(),
                    'date_ad' => now(),
                ]);
        });
        $disabilityIdentityCard->load('disabilityType', 'province', 'district', 'localBody');
        $view = (string)View::make('identity::admin.disabilityIdentityCard.print', compact('todayDate', 'disabilityIdentityCard', 'officeHeaders', 'disabilityPrint', ));
        return response()->json([
            'view' => $view,
        ]);
    }
}
