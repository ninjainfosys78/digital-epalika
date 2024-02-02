<?php

namespace Modules\Grant\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramReportController extends Controller
{
    public function index()
    {

        $columnData = $this->getColumns();
        return view('grant::admin.report.programReport.index', compact('columnData'));
    }

    public function create()
    {
        return view('grant::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('grant::show');
    }

    public function edit($id)
    {
        return view('grant::edit');
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
