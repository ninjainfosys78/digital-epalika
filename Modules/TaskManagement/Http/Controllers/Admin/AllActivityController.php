<?php

namespace Modules\TaskManagement\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\TaskManagement\Entities\Activity;

class AllActivityController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('allTaskActivity_access');
        $activities = Activity::with('branch', 'activityLists', 'user')
            ->where(function ($query) {
                if (auth()->user()->role->type !== 'Super') {
                    $query->where('user_id', auth()->id())
                        ->orWhere('branch_id', auth()->user()->branch_id);
                }
            })
            ->latest('date_en')
            ->paginate(50);
        return view('taskmanagement::admin.all-activity.index', compact('activities'));
    }
}
