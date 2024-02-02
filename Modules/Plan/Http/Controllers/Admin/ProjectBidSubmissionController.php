<?php

namespace Modules\Plan\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Plan\Entities\Project;

class ProjectBidSubmissionController extends Controller
{
    public function index(Project $project)
    {
        $project->loadSum('projectAllocatedAmounts', 'amount');

        return view('plan::admin.project_bid_submission.index', compact('project'));
    }

    public function create()
    {
        return view('plan::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('plan::show');
    }

    public function edit($id)
    {
        return view('plan::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
