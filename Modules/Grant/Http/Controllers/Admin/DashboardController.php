<?php

namespace Modules\Grant\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Grant\Entities\Cooperative;
use Modules\Grant\Entities\Enterprise;
use Modules\Grant\Entities\Farmer;
use Modules\Grant\Entities\Grant;
use Modules\Grant\Entities\GrantDetail;
use Modules\Grant\Entities\Group;

class DashboardController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('grantDashboard_access');

        $farmers_count = Farmer::count();
        $cooperative_count = Cooperative::count();
        $groups_count = Group::count();
        $enterprise_count = Enterprise::count();
        $grant_detail_count = GrantDetail::count();
        return view('grant::admin.dashboard', compact('grant_detail_count', 'enterprise_count', 'farmers_count', 'cooperative_count', 'groups_count'));
    }
    public function ajaxData()
    {
        return [
            'grant' => $this->getGrantData(),
            'wardWiseData' => $this->getWardWiseData()
        ];
    }

    public function getGrantData()
    {
        $grants = Grant::with('grantDetails', 'grantType')->where(function ($q) {
            $q->where('fiscal_year_id', officeSetting()->fiscal_year_id);
        })
            ->withCount('grantDetails')->get()
            ->map(function ($grant) {
                return [
                    'name' => $grant->grantType->title,
                    'total' => $grant->grant_details_count
                ];
            });

        return [
            'labels' => $grants->pluck('name')->toArray(),
            'dataSets' => [
                [
                    'data' => $grants->pluck('total')->toArray(),
                    'label' => 'जम्मा',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    public function getWardWiseData()
    {
        $grantDetails = GrantDetail::whereHas('grant', function ($q) {
            $q->where('fiscal_year_id', \officeSetting()->fiscal_year_id);
        })->get();
        $wardData = collect();
        foreach (officeSetting()->localBody->ward_no as $ward) {
            $wardData->push([
                'ward_no' => 'वडा नं ' . $ward,
                'total' => $grantDetails->where('ward_no', $ward)->count(),
            ]);
        }
        return [
            'labels' => $wardData->pluck('ward_no')->toArray(),
            'dataSets' => [
                [
                    'data' => $wardData->pluck('total')->toArray(),
                    'label' => 'जम्मा',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
            ],
        ];
    }
}
