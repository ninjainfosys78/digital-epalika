<?php

namespace Modules\DigitalBoard\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\Branch;
use App\Models\User;
use Modules\DigitalBoard\Entities\CitizenCharter;
use Modules\DigitalBoard\Http\Requests\CitizenCharter\StoreCitizenCharterRequest;
use Modules\DigitalBoard\Http\Requests\CitizenCharter\UpdateCitizenCharterRequest;

class CitizenCharterController extends Controller
{
    // public function index()
    // {
    //     return view('digitalboard::index');
    // }

    // public function create()
    // {
    //     return view('digitalboard::create');
    // }

    // public function store(Request $request)
    // {
    //     //
    // }

    // public function show($id)
    // {
    //     return view('digitalboard::show');
    // }

    // public function edit($id)
    // {
    //     return view('digitalboard::edit');
    // }

    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // public function destroy($id)
    // {
    //     //
    // }

    public function index()
    {
        $citizenCharters = CitizenCharter::with('branch')
            ->where(function ($q) {
                if (!empty(auth()->user()->ward_no)) {
                    $q->where('ward', auth()->user()->ward_no);
                } else {
                    $q->whereNull('ward');
                }
            })
            ->get();
        return view('digitalboard::admin.citizen_charter.index', compact('citizenCharters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mainBranches = Branch::with('branches')->whereNull('branch_id')->get();
        return view('digitalboard::admin.citizen_charter.create', compact('mainBranches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCitizenCharterRequest $request)
    {
        CitizenCharter::create($request->validated() + [
                'user_id' => auth()->id(),
                'ward' => auth()->user()->ward_no
            ]);
        toast('नागरिक वडापत्र थपियो', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(CitizenCharter $citizenCharter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CitizenCharter $citizenCharter)
    {
        $mainBranches = Branch::with('branches')->whereNull('branch_id')->get();
        $users = User::all();
        return view('digitalboard::admin.citizen_charter.edit', compact('citizenCharter', 'mainBranches', 'users'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCitizenCharterRequest $request, CitizenCharter $citizenCharter)
    {

        $citizenCharter->update($request->validated());
        toast('नागरिक वडापत्र सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CitizenCharter $citizenCharter)
    {
        $citizenCharter->delete();
        toast('नागरिक वडापत्र  मेटियो', 'success');
        return back();
    }
}
