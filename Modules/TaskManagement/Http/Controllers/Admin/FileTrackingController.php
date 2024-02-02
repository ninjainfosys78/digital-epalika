<?php

namespace Modules\TaskManagement\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Modules\TaskManagement\Entities\FileTracking;

class FileTrackingController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('fileTracking_access');

        $fileTrackings = FileTracking::with('user')
            ->whereHas('fileActivities', function ($query) {
                $query->filterData();
            })
            ->orWhere('user_id', auth()->id())
            ->paginate(10);

        return view('taskmanagement::admin.fileTracking.index', compact('fileTrackings'));
    }

    public function create()
    {
        $this->checkAuthorization('fileTracking_create');

        return view('taskmanagement::admin.fileTracking.create');
    }

    public function show(FileTracking $fileTracking)
    {
        $this->checkAuthorization('fileTracking_access');

        $fileTracking->load(['fileActivities' => function ($query) {
            $query->with('users', 'assignedBy');
            $query->filterData();
        }, 'user', 'fileTrackingFiles']);

        $users = User::all();

        return view('taskmanagement::admin.fileTracking.show', compact('fileTracking', 'users'));
    }

    public function edit($id)
    {
        $this->checkAuthorization('fileTracking_edit');

        return view('taskmanagement::edit');
    }

    public function destroy(FileTracking $fileTracking)
    {
        $this->checkAuthorization('fileTracking_delete');

        foreach ($fileTracking->fileTrackingFiles as $fileTrackingFile) {
            $fileTrackingFile->files()->delete();
        }
        $fileTracking->fileTrackingFiles()->delete();
        foreach ($fileTracking->fileActivities as $fileActivity) {
            $fileActivity->users()->detach();
        }
        $fileTracking->fileActivities()->delete();
        $fileTracking->delete();

        toast('File Tracking Deleted Successfully', 'success');
        return back();
    }
}
