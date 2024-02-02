<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficeHeader\UpdateOfficeHeaderRequest;
use App\Models\OfficeHeader;
use Illuminate\Support\Facades\Cache;

class OfficeHeaderController extends Controller
{
    public function edit(OfficeHeader $officeHeader)
    {
        $this->checkAuthorization('officeHeader_edit');
        return view('admin.global.officeSetting.edit', compact('officeHeader'));
    }

    public function update(UpdateOfficeHeaderRequest $request, OfficeHeader $officeHeader)
    {
        $this->checkAuthorization('officeHeader_edit');
        $officeHeader->update($request->validated());
        Cache::forget('officeHeaders');
        toast('सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.global.systemSetting.officeSetting.index'));
    }

    public function destroy(OfficeHeader $officeHeader)
    {
        $this->checkAuthorization('officeHeader_delete');
        $officeHeader->delete();
        Cache::forget('officeHeaders');
        toast('सफलतापूर्वक मेटियो', 'success');

        return back();
    }
}
