<?php

namespace Modules\DigitalBoard\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OfficeHeader;
use App\Models\Settings\Employee;
use App\Models\Settings\OfficeSetting;
use Modules\DigitalBoard\Entities\Notice;
use Modules\DigitalBoard\Entities\Service;
use Modules\DigitalBoard\Entities\Video;
use Modules\DigitalBoard\Transformers\api\v1\ServiceResource;
use Modules\DigitalBoard\Transformers\EmployeeResource;
use Modules\DigitalBoard\Transformers\NewsResource;
use Modules\DigitalBoard\Transformers\NoticeResource;
use Modules\DigitalBoard\Transformers\OfficeHeaderResource;
use Modules\DigitalBoard\Transformers\OfficeSettingResource;
use Modules\DigitalBoard\Transformers\VideoResource;

class DigitalBoardApiController extends Controller
{
    public function home()
    {
        $notices = Notice::with('files')->where(['show_on_index' => 1, 'closed_at' => null])->orderBy('date', 'desc')->get();
        $employees = Employee::where('status', 1)->orderBy('position')->get();
        $videos = Video::latest()->get();
        $services = Service::with('serviceDocuments', 'serviceProcesses', 'serviceEmployees')->latest()->get();

        return [
            'notices' => NoticeResource::collection($notices->where('type', 'Notice')),
            'newses' => NewsResource::collection($notices->where('type', 'News')),
            'videos' => VideoResource::collection($videos),
            'employees' => EmployeeResource::collection($employees),
            'services' => ServiceResource::collection($services),
            'officeSettings' => $this->officeSetting()
        ];
    }

    public function officeSetting()
    {
        $officeSetting = OfficeSetting::first();
        $officeHeaders = OfficeHeader::orderBy('position')->get();

        return [
            'office_headers' => OfficeHeaderResource::collection($officeHeaders),
            'office_setting' => new OfficeSettingResource($officeSetting),
        ];
    }
}
