<?php

namespace Modules\BusinessRegistration\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusinessRegistrationController extends Controller
{
    public function index()
    {
        return view('businessregistration::index');
    }

    public function create()
    {
        return view('businessregistration::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('businessregistration::show');
    }

    public function edit($id)
    {
        return view('businessregistration::edit');
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
