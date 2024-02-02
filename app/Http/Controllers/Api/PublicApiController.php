<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Livewire\OfficeHeader;
use App\Http\Resources\OfficeHeaderResource;
use App\Http\Resources\OfficeSettingResource;
use App\Models\Settings\Employee;
use App\Models\Settings\OfficeSetting;
use Modules\DigitalBoard\Entities\Notice;
use Modules\DigitalBoard\Entities\Video;
use Modules\DigitalBoard\Transformers\NoticeResource ;
use Modules\DigitalBoard\Transformers\EmployeeResource ;
use Modules\DigitalBoard\Transformers\VideoResource ;

class PublicApiController extends Controller
{
    public function home()
    {
        $notices = Notice::where([ 'show_on_index' => 1, 'closed_at' === null])->orderBy('date', 'desc')->get();
        $employees = Employee::where('status', 1)->orderBy('position')->get();
        $videos = Video::latest()->get();
        return [
            'notices' => NoticeResource::collection($notices->where('type', '=', 'Notice')),
            'news' => NoticeResource::collection($notices->where('type', '=', 'News')),
            'employees' => EmployeeResource::collection($employees),
            'videos' => VideoResource::collection($videos)
        ];
    }

    public function officeSetting()
    {
        $officeSetting = OfficeSetting::first();
        $officeHeaders = OfficeHeader::orderBy('position')->get();
        return [
            'office_setting' => new OfficeSettingResource($officeSetting),
            'office_headers' => OfficeHeaderResource::collection($officeHeaders)
        ];
    }
}
