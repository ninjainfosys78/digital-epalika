<?php

namespace Modules\Identity\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IdentityController extends Controller
{
    public function index()
    {
        return view('identity::index');
    }

    public function create()
    {
        return view('identity::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('identity::show');
    }

    public function edit($id)
    {
        return view('identity::edit');
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
