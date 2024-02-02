<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\JudicialCommittee\Entities\ComplaintApplication;

class ComplaintLogController extends Controller
{
    public function index(ComplaintApplication $complaintApplication)
    {
        $complaintApplication->load('complaintLogs');

        return view('judicialcommittee::admin.complaint_log.index', compact('complaintApplication'));
    }
}
