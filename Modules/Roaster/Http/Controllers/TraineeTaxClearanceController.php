<?php

namespace Modules\Roaster\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Roaster\Entities\TraineeTaxClearance;

class TraineeTaxClearanceController extends Controller
{
    public function index()
    {
        $taxClearances = TraineeTaxClearance::where('trainee_user_detail_id', auth('traineeUser')
            ->user()->traineeUserDetail->id)
            ->latest()
            ->get();

        return view('roaster::traineeUser.tax-clearance.index', compact('taxClearances'));
    }

    public function create()
    {
        return view('roaster::traineeUser.tax-clearance.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'year' => ['required'],
            'document' => ['required', 'mimes:png,jpg,jpeg'],
        ]);
        TraineeTaxClearance::create($data + [
            'trainee_user_detail_id' => auth('traineeUser')->user()->traineeUserDetail->id,
        ]);

        toast('कर चुक्ता सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(TraineeTaxClearance $traineeTaxClearance)
    {
        return view('roaster::show');
    }

    public function edit(TraineeTaxClearance $traineeTaxClearance)
    {
        return view('roaster::traineeUser.tax-clearance.edit', compact('traineeTaxClearance'));
    }

    public function update(Request $request, TraineeTaxClearance $traineeTaxClearance)
    {
        $data = $request->validate([
            'year' => ['required'],
            'document' => ['nullable', 'mimes:png,jpg,jpeg'],
        ]);
        $traineeTaxClearance->update($data);
        toast('कर चुक्ता सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('traineeOrganization.admin.traineeTaxClearance.index'));
    }

    public function destroy(TraineeTaxClearance $traineeTaxClearance)
    {
        $traineeTaxClearance->delete();
        toast(' सफलतापूर्वक मेटियो', 'success');

        return back();
    }
}
