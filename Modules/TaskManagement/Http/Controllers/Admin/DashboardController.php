<?php

namespace Modules\TaskManagement\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\NepaliDateConverter;
use Carbon\CarbonPeriod;
use Modules\TaskManagement\Entities\Activity;

class DashboardController extends Controller
{
    use NepaliDateConverter;

    private $activities;

    public function __construct()
    {
        parent::__construct();
        $this->activities = Activity::withCount('activityLists')->with('activityLists')->get();
    }

    public function index()
    {
        $this->checkAuthorization('taskManagementDashboard_access');

        $todayTaskCount = $this->activities
            ->where('date_en', today())
            ->sum('activity_lists_count');
        $todayActivity = $this->activities
            ->where('user_id', auth()->id())
            ->where('date_en', today());
        $currentUserTodayTaskCount = $todayActivity
            ->sum('activity_lists_count');
        $users = User::withCount(['activities' => fn ($query) => $query->where('date_en', today())])->get();
        $taskSubmittedUserCount = $users->where('activities_count', '>', 0)->count();
        $taskNotSubmittedUserCount = $users->where('activities_count', '<=', 0)->count();
        return view('taskmanagement::admin.dashboard', compact(
            'todayTaskCount',
            'currentUserTodayTaskCount',
            'todayActivity',
            'taskSubmittedUserCount',
            'taskNotSubmittedUserCount'
        ));
    }
    public function ajaxData()
    {
        return [
            'dailyTask' => $this->dailyTask(),
        ];
    }
    public function dailyTask()
    {
        $ranges = CarbonPeriod::create(today()->subDays(6), today());
        $data = collect();
        foreach ($ranges as $range) {
            $nepaliDate = $this->get_nepali_date($range->format('Y'), $range->format('m'), $range->format('d'));

            $data->push([
                'label' => $nepaliDate['y'] . "/" . $nepaliDate['m'] . "/" . $nepaliDate['d'],
                'count' => (int)count($this->activities
                    ->where('user_id', auth()->id())
                    ->where('date_en', $range)
                    ->pluck('activityLists'))
            ]);
        }


        return [
            'labels' => $data->pluck('label')->toArray(),
            'dataSets' => [
                [
                    'data' => $data->pluck('count')->toArray(),
                    'label' => 'जम्मा नक्सा',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ]
            ],
        ];
    }
}
