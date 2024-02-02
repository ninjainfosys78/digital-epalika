<?php

namespace Modules\Identity\Http\Controllers;

use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Modules\Identity\Entities\DisabilityIdentityCard;
use Modules\Identity\Entities\SeniorCitizenDetail;

class DashboardController extends Controller
{
    protected Collection $disabilityIdentityCard ;
    protected Collection $seniorCitizenDetail;

    public function __construct()
    {
        parent::__construct();

        $this->disabilityIdentityCard = DisabilityIdentityCard::get();
        $this->seniorCitizenDetail = SeniorCitizenDetail::get();
    }
    public function index()
    {
        $this->checkAuthorization('identityDashboard_access');

        $disabilityIdentityCardCount = $this->disabilityIdentityCard->count();
        $seniorCitizenDetailCount = $this->seniorCitizenDetail->count();
        $fiscalYearWiseDisabilityCount = $this->disabilityIdentityCard->where('fiscal_year_id', officeSetting()->fiscal_year_id)->count();
        $fiscalYearWiseSeniorCitizenDetail = $this->seniorCitizenDetail->where('fiscal_year_id', officeSetting()->fiscal_year_id)->count();

        return view('identity::admin.dashboard', compact('fiscalYearWiseSeniorCitizenDetail', 'disabilityIdentityCardCount', 'fiscalYearWiseDisabilityCount', 'seniorCitizenDetailCount'));
    }

    public function ajaxData()
    {
        return [
            'wardWise' => $this->getWardWiseData(),
            'SeniorDetailWardWise' => $this->getSeniorDetailWardWiseData(),
        ];
    }
    public function getWardWiseData()
    {
        $wardsData = collect();
        foreach (\officeSetting()->localBody->ward_no as $ward) {
            $wardsData->push([
                'ward_no' => "वडा नं. $ward",
                'disability_identity_card' => $this->disabilityIdentityCard
                    ->where('permanent_ward', $ward)
                    ->where('fiscal_year_id', officeSetting()->fiscal_year_id)
                    ->count()
            ]);
        }

        return [
            'labels' => $wardsData->pluck('ward_no')->toArray(),
            'dataSets' => [
                [
                    'data' => $wardsData->pluck('disability_identity_card')->toArray(),
                    'label' => 'जम्मा',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    public function getSeniorDetailWardWiseData()
    {
        $wardsData = collect();
        foreach (\officeSetting()->localBody->ward_no as $ward) {
            $wardsData->push([
                'ward_no' => "वडा नं. $ward",
                'senior_citizen_detail_count' => $this->seniorCitizenDetail
                    ->where('ward_no', $ward)
                    ->where('fiscal_year_id', officeSetting()->fiscal_year_id)
                    ->count()
            ]);
        }

        return [
            'labels' => $wardsData->pluck('ward_no')->toArray(),
            'dataSets' => [
                [
                    'data' => $wardsData->pluck('senior_citizen_detail_count')->toArray(),
                    'label' => 'जम्मा',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
            ],
        ];
    }
}
