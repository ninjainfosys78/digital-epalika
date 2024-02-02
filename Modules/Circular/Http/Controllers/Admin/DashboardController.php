<?php

namespace Modules\Circular\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings\FiscalYear;
use App\Models\Settings\OfficeSetting;
use App\Traits\NepaliDateConverter;
use Illuminate\Support\Collection;
use Modules\Circular\Entities\Dispatch;
use Modules\Circular\Entities\Registration;

class DashboardController extends Controller
{
    use NepaliDateConverter;

    protected Collection $currentYearRegistrations;
    protected Collection $currentYearDispatches;
    protected OfficeSetting $officeSetting;

    public function __construct()
    {
        parent::__construct();

        $this->officeSetting = officeSetting();
        $this->currentYearRegistrations = Registration::where('fiscal_year_id', $this->officeSetting->fiscal_year_id)->get();
        $this->currentYearDispatches = Dispatch::where('fiscal_year_id', $this->officeSetting->fiscal_year_id)->get();
    }

    public function index()
    {
        $this->checkAuthorization('circularDashboard_access');

        $nepali_date = $this->get_nepali_date(now()->format('Y'), now()->format('m'), now()->format('d'));

        $total_registrations = Registration::count();
        $monthly_registrations = $this->currentYearRegistrations->where('registration_month', $nepali_date['m'])->count();
        $total_dispatches = Dispatch::count();
        $monthly_dispatches = $this->currentYearDispatches->where('dispatch_month', $nepali_date['m'])->count();

        return view(
            'circular::admin.dashboard',
            compact(
                'total_registrations',
                'monthly_registrations',
                'total_dispatches',
                'monthly_dispatches'
            )
        );
    }
    public function ajaxData()
    {
        return [
            'fyRegistrationAndDispatch' => $this->getFyRegistrationAndDispatchData(),
            'totalMonthRegistrationAndDispatch' => $this->getCurrentFyRegistrationAndDispatch()
        ];
    }
    /**
     * @return array
     */
    public function getFyRegistrationAndDispatchData(): array
    {
        $fiscalYears = FiscalYear::withCount(['registrations', 'dispatch'])
            ->get()
            ->map(function ($fiscalYear) {
                return [
                    'title' => $fiscalYear->title,
                    'registrations_count' => (int)$fiscalYear->registrations_count,
                    'dispatch_count' => (int)$fiscalYear->dispatch_count,
                ];
            });

        return [
            'labels' => $fiscalYears->pluck('title')->toArray(),
            'dataSets' => [
                [
                    'data' => $fiscalYears->pluck('registrations_count')->toArray(),
                    'label' => 'दर्ता',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
                [
                    'data' => $fiscalYears->pluck('dispatch_count')->toArray(),
                    'label' => 'चलानी',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    public function getCurrentFyRegistrationAndDispatch(): array
    {
        $monthlyRegistrations = [];
        $monthlyDispatches = [];

        foreach ($this->month_name as $key => $month) {
            $monthlyRegistrations[] = $this->currentYearRegistrations->where('registration_month', ($key + 1))->count();
            $monthlyDispatches[] = $this->currentYearDispatches->where('dispatch_month', ($key + 1))->count();
        }

        return [
            'labels' => $this->month_name,
            'dataSets' => [
                [
                    'data' => $monthlyRegistrations,
                    'label' => 'दर्ता',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
                [
                    'data' => $monthlyDispatches,
                    'label' => 'चलानी',
                    'backgroundColor' => 'rgba(0, 145, 62, 1)',
                    'borderColor' => 'rgba(0, 145, 62, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }
}
