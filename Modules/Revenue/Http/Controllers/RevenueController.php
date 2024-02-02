<?php

namespace Modules\Revenue\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RevenueController extends Controller
{
    public function index()
    {
        return view('revenue::index');
    }

    public function create()
    {
        return view('revenue::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('revenue::show');
    }

    public function edit($id)
    {
        return view('revenue::edit');
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
