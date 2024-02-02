<?php

namespace Modules\DigitalBoard\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Settings\Branch;
use App\Models\Settings\Employee;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

use Modules\DigitalBoard\Entities\Audio;
use Modules\DigitalBoard\Entities\CitizenCharter;
use Modules\DigitalBoard\Entities\Notice;
use Modules\DigitalBoard\Entities\PopUpNotice;
use Modules\DigitalBoard\Entities\PhotoGallery;

use Modules\DigitalBoard\Entities\Service;
use Modules\DigitalBoard\Entities\Video;
use Modules\DigitalBoard\Transformers\api\v1\BranchResource;
use Modules\DigitalBoard\Transformers\api\v1\CitizenCharterResource;
use Modules\DigitalBoard\Transformers\api\v1\EmployeeResource;
use Modules\DigitalBoard\Transformers\api\v1\NewsResource;
use Modules\DigitalBoard\Transformers\api\v1\NoticeResource;
use Modules\DigitalBoard\Transformers\api\v1\ServiceResource;

use Modules\DigitalBoard\Transformers\AudioResource;
use Modules\DigitalBoard\Transformers\PhotoGalleryResource;
use Modules\DigitalBoard\Transformers\RepresentativeResource;
use Modules\DigitalBoard\Transformers\MarqueNewsResource;
use Modules\DigitalBoard\Transformers\PopUpNoticeResource;

use Modules\DigitalBoard\Transformers\VideoResource;

class PublicApiController extends Controller
{
    public function employee(): AnonymousResourceCollection
    {
        $employees = Employee::orderBy('position')
            ->active()
            ->employee()
            ->showForMobileAppRequest()->get();

        return EmployeeResource::collection($employees);
    }

    public function publicRepresentative(): AnonymousResourceCollection
    {
        $employees = Employee::orderBy('position')
            ->active()
            ->peopleRepresentative()
            ->showForMobileAppRequest()
            ->get();

        return EmployeeResource::collection($employees);
    }
    public function marqueNews(): AnonymousResourceCollection
    {
        return MarqueNewsResource::collection(Notice::where('type', 'news')->latest()->get());


    }

    public function latestNews(): AnonymousResourceCollection
    {
        return NewsResource::collection(Notice::where('type', 'news')->with('files')->latest()->get());

    }
    public function photoGallery(): AnonymousResourceCollection
    {
        $photoGalleries = PhotoGallery::get();

        return PhotoGalleryResource::collection($photoGalleries);
    }
    public function audio(): AnonymousResourceCollection
    {
        $audios = Audio::get();

        return AudioResource::collection($audios);
    }
    public function representative(string $employeeType): AnonymousResourceCollection
    {
        $representatives = Employee::where(function ($q) use ($employeeType) {
            if ($employeeType == 'employee') {
                $q->where('is_employee', 1);
            } else {
                $q->where('is_employee', 0);
            }
        })
            ->get();

        return RepresentativeResource::collection($representatives);
    }

    public function notice(): AnonymousResourceCollection
    {
        return NoticeResource::collection(Notice::where('type', 'notice')->with('files')->latest()->get());

    }

    public function video(): AnonymousResourceCollection
    {
        $videos = Video::latest()->get();

        return VideoResource::collection($videos);
    }

    public function popUpNotice(): AnonymousResourceCollection
    {
        $popUpNotices = PopUpNotice::latest()->with('files')->get();

        return PopUpNoticeResource::collection($popUpNotices);
    }

    public function showNotice(Notice $notice): NoticeResource
    {
        return NoticeResource::make($notice->load('files'));
    }

    public function branch(): AnonymousResourceCollection
    {
        $branches = Branch::with('branches')->whereNull('branch_id')->get();

        return BranchResource::collection($branches);
    }

    public function getBranchDetail(Branch $branch): BranchResource
    {
        return BranchResource::make($branch->load('services'));
    }

    public function getBranchService(Branch $branch): AnonymousResourceCollection
    {
        $branch->load('services');
        return ServiceResource::collection($branch->services);
    }

    public function getAllService(): AnonymousResourceCollection
    {
        $services = CitizenCharter::with('branch')->get();
        return CitizenCharterResource::collection($services);
    }

    public function getService(Service $service): ServiceResource
    {
        return ServiceResource::make($service->load('serviceDocuments', 'serviceEmployees', 'serviceProcesses', 'branch'));
    }
}
