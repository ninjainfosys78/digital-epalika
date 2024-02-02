<?php

namespace Modules\EMap\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplyMapNoticeController extends Controller
{
    public function index()
    {
        return view('emap::index');
    }

    public function create()
    {
        return view('emap::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('emap::show');
    }

    public function edit($id)
    {
        return view('emap::edit');
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
