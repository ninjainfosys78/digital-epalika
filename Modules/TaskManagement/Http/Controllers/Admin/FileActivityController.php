<?php

namespace Modules\TaskManagement\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Enum;
use Modules\TaskManagement\Entities\FileActivity;
use Modules\TaskManagement\Entities\FileTracking;
use Modules\TaskManagement\Enums\FileStatusEnum;

class FileActivityController extends Controller
{
    public function updateReceivedStatus(FileTracking $fileTracking, FileActivity $fileActivity)
    {
        $this->checkAuthorization('fileTracking_edit');

        if ($fileActivity->received_by && auth()->user()->role->type != 'Super') {
            toast('File Already Received', 'error');
            return back();
        }

        $fileActivity->update([
            'received_by' => is_null($fileActivity->received_by) ? auth()->id() : null
        ]);

        toast('Status Updated Successfully', 'success');
        return back();
    }

    public function updateStatus(Request $request, FileTracking $fileTracking, FileActivity $fileActivity)
    {
        $this->checkAuthorization('fileTracking_edit');

        $request->validate([
            'status' => ['nullable', new Enum(FileStatusEnum::class)]
        ]);

        $fileActivity->update([
            'status' => $request->input('status')
        ]);

        toast('Status Updated Successfully', 'success');
        return back();
    }
}
