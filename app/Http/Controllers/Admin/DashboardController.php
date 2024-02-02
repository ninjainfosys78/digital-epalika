<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Settings\OfficeSetting;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Modules\BusinessRegistration\Entities\BusinessDetail;
use Modules\EMap\Entities\MapApply;
use Modules\GrievanceHandling\Entities\GrievanceDetail;
use Modules\Plan\Entities\PlanArea;
use Modules\Plan\Entities\Project;
use Modules\Roaster\Entities\Training;
use Schema;
use Modules\EMap\Http\Controllers\Admin\DashboardController as EmapDashboardController;
use Modules\Revenue\Http\Controllers\Admin\DashboardController as RevenueDashboardController;
use Modules\DigitalBoard\Http\Controllers\Admin\DashboardController as DigitalDashboardController;
use Modules\Recommendation\Http\Controllers\Admin\DashboardController as RecommendationDashboardController;
use Modules\Roaster\Http\Controllers\DashboardController as RoasterDashboardController;
use Modules\BusinessRegistration\Http\Controllers\Admin\DashboardController as BusinessRegistrationDashboardController;
use Modules\Identity\Http\Controllers\DashboardController as IdentityDashboardController;
use Modules\Circular\Http\Controllers\Admin\DashboardController as CircularDashboardController;

class DashboardController extends Controller
{
    protected Collection $projects;
    protected Collection $revenues;

    public function __construct()
    {
        parent::__construct();
        if (Schema::hasTable('invoices')) {
            $this->revenues = DB::table('invoices')
                ->selectRaw('invoices.is_cash_invoice,invoices.payment_method,invoices.payment_date,invoices.payment_date_en,invoices.fiscal_year_id, SUM((invoice_particulars.rate * invoice_particulars.quantity)+ (invoice_particulars.rate * invoice_particulars.quantity) * invoice_particulars.due + invoice_particulars.fine) as total')
                ->join('invoice_particulars', 'invoice_particulars.invoice_id', '=', 'invoices.id')
                ->whereNull('invoices.deleted_at')
                ->whereNull('invoice_particulars.deleted_at')
                ->groupBy('invoices.fiscal_year_id', 'invoices.payment_date', 'invoices.is_cash_invoice', 'invoices.payment_method', 'invoices.payment_date_en')
                ->get();
        }
        if (Schema::hasTable('projects')) {
            $this->projects = Project::where('fiscal_year_id', officeSetting()->fiscal_year_id ?? '')->get();
        }
    }

    public function index()
    {
        //dashboard redirection for particular module
        $dashboardPermissions = collect([
            'digitalBoardDashboard_access',
            'circularDashboard_access',
            'listRegistrationDashboard_access',
            'grievanceHandlingDashboard_access',
            'executiveMeetingDashboard_access',
            'eMapDashboard_access',
            'businessRegistrationDashboard_access',
            'recommendationDashboard_access',
            'taskManagementDashboard_access',
            'roasterDashboard_access',
            'judicialCommitteeDashboard_access',
            'planDashboard_access',
            'grantDashboard_access',
            'revenueDashboard_access',
            'identityDashboard_access'
        ]);
        $userPermissions = $dashboardPermissions->intersect(collect(auth()->user()->role->permissions->pluck('title')));
        if ($userPermissions->count() == 1) {
            $permission = $userPermissions->first();
            $routeName = match ($permission) {
                'digitalBoardDashboard_access' => route('admin.digitalBoard.dashboard'),
                'circularDashboard_access' => route('admin.circular.dashboard'),
                'listRegistrationDashboard_access' => route('admin.listRegistrations.dashboard'),
                'grievanceHandlingDashboard_access' => route('admin.grievanceHandling.dashboard'),
                'executiveMeetingDashboard_access' => route('admin.executiveMeeting.dashboard'),
                'eMapDashboard_access' => route('emap.admin.dashboard'),
                'businessRegistrationDashboard_access' => route('admin.businessRegistration.dashboard'),
                'recommendationDashboard_access' => route('admin.recommendation.dashboard'),
                'taskManagementDashboard_access' => route('admin.taskManagement.dashboard'),
                'roasterDashboard_access' => route('admin.roaster.dashboard'),
                'judicialCommitteeDashboard_access' => route('admin.judicialCommittee.dashboard'),
                'planDashboard_access' => route('admin.plan.dashboard'),
                'grantDashboard_access' => route('admin.grant.dashboard'),
                'revenueDashboard_access' => route('admin.revenue.dashboard'),
                'identityDashboard_access' => route('identity.admin.dashboard'),
                default => route('admin.dashboard'),
            };
            return redirect($routeName);
        }



        $businessDetail_count = 0;
        $training_count = 0;
        $project_count = 0;
        $map_count = 0;
        $grievance_count = 0;
        $planAreas = [
            'labels' => [],
            'dataSets' => [
                [
                    'data' => [],
                ]
            ]
        ];

        $user_count = User::count();
        $activityLogs = ActivityLog::with('user')
            ->filter()
            ->whereDate('created_at', today()->toDateString())
            ->paginate(5);

        if (Schema::hasTable('business_details')) {
            $businessDetail_count = BusinessDetail::whereNotNull('registration_no')
                ->count();
        }

        if (Schema::hasTable('trainings')) {
            $training_count = Training::whereDate('closed_date', '<=', today()->toDateString())
                ->count() ?? 0;
        }

        if (Schema::hasTable('projects')) {
            $project_count = Project::count() ?? 0;
        }

        if (Schema::hasTable('map_applies')) {
            $map_count = MapApply::count() ?? 0;
        }

        if (Schema::hasTable('grievance_details')) {
            $grievance_count = GrievanceDetail::approved()->count() ?? 0;
        }

        if (Schema::hasTable('plan_areas')) {
            $planAreas = $this->setPlanData();
        }

        return view('admin.dashboard', compact([
            'user_count',
            'businessDetail_count',
            'planAreas',
            'activityLogs',
            'training_count',
            'project_count',
            'map_count',
            'grievance_count'
        ]));
    }
    public function ajaxData()
    {
        return [
            "allNoticeAccordingMonth" => (new DigitalDashboardController())-> getNoticeAccordingToMonth(),
            "wardWiseRegistration" => (new RecommendationDashboardController())->getWardWiseData(),
            "totalRevenue" => (new RevenueDashboardController())->totalRevenue($this->revenues),
            "totalCashBankRevenue" => (new RevenueDashboardController())->totalCashBankRevenue($this->revenues),
            "trainerAccordingToSubject" => (new RoasterDashboardController())->trainerAccordingToSubject(),
            'mapAccordingToMonth' => (new EmapDashboardController())->mapAccordingToMonth(),
            "businessRegistration" => (new BusinessRegistrationDashboardController())->getBusinessRegistrationAccordingToFiscalYear(),
            "wardWise" => (new IdentityDashboardController())->getWardWiseData(),
            "fyRegistrationAndDispatch" => (new CircularDashboardController())->getFyRegistrationAndDispatchData(),

        ];
    }

    private function setPlanData(): array
    {
        $officeSetting = OfficeSetting::first();

        $planAreas = PlanArea::withCount([
            'projects' => function ($query) use ($officeSetting) {
                $query->where('fiscal_year_id', $officeSetting->fiscal_year_id);
            }
        ])
            ->with([
                'planAreas' => function ($query) use ($officeSetting) {
                    $query->withCount([
                        'projects' => function ($sub_query) use ($officeSetting) {
                            $sub_query->where('fiscal_year_id', $officeSetting->fiscal_year_id);
                        }
                    ]);
                }
            ])->whereNull('plan_area_id')->get()->map(function ($planArea) {
                return [
                    'area_name' => $planArea->area_name ?? '',
                    'projects_count' => $planArea->projects_count + $planArea->planAreas->sum('projects_count')
                ];
            });


        return [
            'labels' => $planAreas->pluck('area_name')->toArray(),
            'dataSets' => [
                [
                    'data' => $planAreas->pluck('projects_count')->toArray(),
                    'label' => 'जम्मा',
                    'fill' => 'false',
                ],
            ],
        ];
    }

    public function cacheClear()
    {
        Artisan::call('optimize:clear');
        return [
            'message' => 'क्यास सफलतापूर्वक खाली गरियो'
        ];
    }
}
