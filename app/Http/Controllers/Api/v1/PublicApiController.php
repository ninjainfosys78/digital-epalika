<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\EmergencyCategoryResource;
use App\Http\Resources\Api\v1\LinkResource;
use App\Http\Resources\Api\v1\SettingResource;
use App\Http\Resources\Api\v1\SliderResource;
use App\Models\OfficeHeader;
use App\Models\Settings\EmergencyCategory;
use App\Models\Settings\Employee;
use App\Models\Settings\OfficeSetting;
use App\Models\Website\ImportantLink;
use App\Models\Website\Slider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\DigitalBoard\Entities\Notice;
use Modules\DigitalBoard\Entities\PopUpNotice;
use Modules\DigitalBoard\Entities\Video;
use Modules\DigitalBoard\Transformers\api\v1\EmployeeResource;
use Modules\DigitalBoard\Transformers\api\v1\NewsResource;
use Modules\DigitalBoard\Transformers\api\v1\NoticeResource;
use Modules\DigitalBoard\Transformers\PopUpNoticeResource;
use Modules\DigitalBoard\Transformers\VideoResource;
use Nwidart\Modules\Facades\Module;
use Modules\DigitalBoard\Entities\Audio;
use Modules\DigitalBoard\Entities\PhotoGallery;
use Modules\DigitalBoard\Transformers\AudioResource;
use Modules\DigitalBoard\Transformers\OfficeHeaderResource;
use Modules\DigitalBoard\Transformers\PhotoGalleryResource;

class PublicApiController extends Controller
{
    public function getToken(): JsonResponse
    {
        if (auth('web')->check()) {
            $token = auth()->user()?->createToken('report user token');

            return response()->json([
                'message' => 'Successfully',
                'data' => $token->plainTextToken
            ]);
        }
        return response()->json(['message' => 'Please Login First'], 400);
    }

    public function index(): array
    {
        return array_merge($this->getDataFromMainModule(), $this->checkModuleData(), $this->getAllModulesData());
    }

    public function setting()
    {
        $officeSetting = $this->getOfficeSetting();
        $officeHeader = $this->getOfficeHeader();

        return [
            'setting' => new SettingResource($officeSetting),
            'header' => new OfficeHeaderResource($officeHeader),
        ];
    }

    public function slider(): AnonymousResourceCollection
    {
        return SliderResource::collection(Slider::latest()->get());
    }

    public function importantLink(): AnonymousResourceCollection
    {
        return LinkResource::collection(ImportantLink::latest()->get());
    }

    public function emergencyCategory(): AnonymousResourceCollection
    {
        $emergencyCategories = EmergencyCategory::latest()->get();

        return EmergencyCategoryResource::collection($emergencyCategories);

    }

    public function emergencyNumber(EmergencyCategory $emergencyCategory)
    {
        return EmergencyCategoryResource::make($emergencyCategory->load('emergencyNumbers'));

    }

    public function introduction(): array
    {
        $setting = $this->getOfficeSetting();

        return [
            'introduction' => strip_tags($setting->introduction ?? '') ?? ''
        ];
    }

    public function getOfficeSetting()
    {
        return OfficeSetting::with('localBody')->first();
    }

    public function getOfficeHeader(): OfficeHeader
    {
        return OfficeHeader::latest()->firstOrFail();
    }

    public function checkModuleData(): array
    {
        $modules = Module::collections();

        return $this->getDataFromDigitalBoardModule($modules);
    }


    public function getDataFromDigitalBoardModule($modules): array
    {
        if ($modules->has('DigitalBoard')) {
            return [
                'employees' => EmployeeResource::collection(Employee::orderBy('position')->employee()->active()->showForMobileAppRequest()->get()),
                'representatives' => EmployeeResource::collection(Employee::orderBy('position')->peopleRepresentative()->active()->showForMobileAppRequest()->get()),
                'news' => NewsResource::collection(Notice::orderByDesc('date')->news()->showInIndex()->nullClosedAt()->limit(3)->get()),
                'notices' => NoticeResource::collection(Notice::with('files')->orderByDesc('date')->notice()->showInIndex()->nullClosedAt()->limit(3)->get()),
                'emergencyCategories' => EmergencyCategoryResource::collection(EmergencyCategory::get()),
                'latestNews' => NewsResource::collection(Notice::with('files')->news()->latest()->get()),
                'popups' => PopUpNoticeResource::collection(PopUpNotice::with('files')->latest()->get()),
                'video' => VideoResource::collection(Video::latest()->get()),
                'audio' => AudioResource::collection(Audio::latest()->get()),
                'photoGallery' => PhotoGalleryResource::collection(PhotoGallery::latest()->get())
            ];
        }
        return [
            'employees' => [],
            'news' => [],
            'notices' => [],
            'emergencyCategories' => [],
            'latestNews' => [],
            'popups' => [],
            'video' => [],
            'audio' => [],
            'photoGallery' => [],
        ];
    }


    public function getDataFromMainModule(): array
    {
        $setting = $this->getOfficeSetting();
        return [
            'setting' => SettingResource::make($setting),
            'sliders' => $this->slider(),
        ];
    }


    public function getAllModulesData(): array
    {
        return [
//            'modules' => [
//                [
//                    'name' => 'गुनासो',
//                    'logo' => asset('assets/backend/images/modules/grievancehandling.png'),
//                    'url' => route('grievanceHandling.grievance')
//                ],
//                [
//                    'name' => 'घर-नक्सा',
//                    'logo' => asset('assets/backend/images/modules/emap.png'),
//                    'url' => route('ebps')
//                ],
//                [
//                    'name' => 'हेल्प डेस्क',
//                    'logo' => asset('assets/backend/images/modules/helpdesk.png'),
//                    'url' => route('helpdesk.helpdesk')
//                ],
//                [
//                    'name' => 'व्यवसाय दर्ता',
//                    'logo' => asset('assets/backend/images/modules/businessregistration.png'),
//                    'url' => route('businessRegistration.business')
//                ],
//                [
//                    'name' => 'अनुदान',
//                    'logo' => asset('assets/backend/images/modules/anudan.png'),
//                    'url' => route('grant.index')
//                ],
//                [
//                    'name' => 'तालिम',
//                    'logo' => asset('assets/backend/images/modules/roaster.png'),
//                    'url' => route('roaster.index')
//                ],
//            ]
        ];
    }

    public function getGovtServices(): array
    {
        return [
            /* [
                 'name' => 'जिन्सी व्यवस्थापन प्रणाली',
                 'logo' => asset('assets/frontend/image/logo.png'),
                 'url' => 'https://pams.fcgo.gov.np/',
             ],
             [
                 'name' => 'संचितकोष व्यवस्थापन प्रणाली',
                 'logo' => asset('assets/frontend/image/logo.png'),
                 'url' => 'https://sutra.fcgo.gov.np/',
             ],*/
            [
                'name' => 'घटना दर्ता र सामाजिक सुरक्षा प्रणाली',
                'logo' => asset('assets/frontend/image/logo.png'),
                'url' => 'https://public.donidcr.gov.np/',
            ],
            /* [
                 'name' => 'इमेल सेवा',
                 'logo' => asset('assets/frontend/image/logo.png'),
                 'url' => 'https://mail.nepal.gov.np/',
             ],
             [
                 'name' => 'कार्यालयको हाजिरी',
                 'logo' => asset('assets/frontend/image/logo.png'),
                 'url' => 'https://attendance.gov.np/',
             ],
             [
                 'name' => 'एस.एम.एस',
                 'logo' => asset('assets/frontend/image/logo.png'),
                 'url' => 'https://sms.aakashsms.com/login',
             ],
             [
                 'name' => 'Voice एस.एम.एस',
                 'logo' => asset('assets/frontend/image/logo.png'),
                 'url' => 'https://apps.aakashtel.com/login',
             ],*/
        ];
    }
}
