<?php

namespace Modules\Identity\Http\Controllers;

use App\Models\OfficeHeader;
use App\Traits\NepaliDateConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Modules\Identity\Entities\SeniorCitizenDetail;

class SeniorCitizenDetailController extends Controller
{
    use NepaliDateConverter;
    public function index()
    {
        $seniorCitizenDetails = SeniorCitizenDetail::filterData()->get();
        return view('identity::admin.seniorCitizen.index', compact('seniorCitizenDetails'));
    }

    public function create()
    {
        return view('identity::admin.seniorCitizen.create');
    }

    public function store(Request $request)
    {
    }

    public function show(SeniorCitizenDetail $seniorCitizenDetail)
    {
        $this->authorize('view', $seniorCitizenDetail);
        $officeHeaders = OfficeHeader::get();
        $todayDate = $this->get_today_nepali_date();
        $seniorCitizenDetail->load('fingerPrints', 'province', 'district', 'localBody', 'employeeSignature');

        return view('identity::admin.seniorCitizen.show', compact('seniorCitizenDetail', 'officeHeaders', 'todayDate'));
    }

    public function edit(SeniorCitizenDetail $seniorCitizenDetail)
    {
        $this->authorize('update', $seniorCitizenDetail);
        $seniorCitizenDetail->load('province', 'district', 'localBody');
        return view('identity::admin.seniorCitizen.edit', compact('seniorCitizenDetail'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(SeniorCitizenDetail $seniorCitizenDetail)
    {
        $this->authorize('delete', $seniorCitizenDetail);
        $seniorCitizenDetail->delete();

        toast('जेष्ठ नागरिक विवरण सफलतापुर्बक हटाइयो', 'success');
        return back();
    }

    public function searchCitizenshipNo()
    {
        return view('identity::admin.seniorCitizen.citizenship_search');
    }

    public function print(SeniorCitizenDetail $seniorCitizenDetail)
    {
        $officeHeaders = OfficeHeader::get();
        $todayDate = $this->get_today_nepali_date();
        $seniorCitizenDetail->load('fingerPrints', 'employeeSignature', 'province', 'district', 'localBody');
        $view = (string)View::make('identity::admin.seniorCitizen.print', compact('todayDate', 'seniorCitizenDetail', 'officeHeaders'));

        return response()->json([
            'view' => $view,
        ]);
    }
}
