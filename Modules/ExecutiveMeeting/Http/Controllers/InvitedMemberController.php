<?php

namespace Modules\ExecutiveMeeting\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvitedMemberController extends Controller
{
    public function index()
    {
        return view('executivemeeting::index');
    }

    public function create()
    {
        return view('executivemeeting::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('executivemeeting::show');
    }

    public function edit($id)
    {
        return view('executivemeeting::edit');
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
