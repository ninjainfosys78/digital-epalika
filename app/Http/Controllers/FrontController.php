<?php

namespace App\Http\Controllers;

use App\Models\MobileUser;
use App\Models\OfficeHeader;
use App\Models\Settings\Employee;
use App\Models\Website\ImportantLink;
use App\Models\Website\MunicipalDetail;
use App\Models\Website\Slider;
use App\Traits\NepaliDateConverter;
use Illuminate\Support\Facades\Route;
use Modules\DigitalBoard\Entities\Notice;
use Modules\ExecutiveMeeting\Entities\MeetingDecision;
use Modules\Identity\Entities\DisabilityIdentityCard;
use Modules\Identity\Entities\SeniorCitizenDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    use NepaliDateConverter;

    public function __construct()
    {
        parent::__construct();
        view()->share('important_links', ImportantLink::all());
    }

    public function index()
    {
        if (!$this->checkModuleExistence('DigitalBoard')) {
            return view('frontend.digital_board');
        } elseif (Route::has('grievanceHandling.grievance')
            || Route::has('ebps')
            || Route::has('digitalBoard.helpdesk.helpdesk')
            || Route::has('recommendation.index')
            || Route::has('businessRegistration.business')
            || Route::has('grant.index')
            || Route::has('payment.index')
            || Route::has('complaintApplication.complainRegistration')
            || Route::has('roaster.index')) {
            return redirect(route('digital-service'));
        } else {
            return redirect(route('login'));
        }
        /*if (config('app.website_type') === 'website') {
            $employees = Employee::orderBy('position')->get();

            $notices = Notice::where('type', 'Notice')->orderBy('date')->limit(3)->get();
            $newses = Notice::where('type', 'News')->orderBy('date')->limit(3)->get();

            $meetingDecisions = MeetingDecision::with('meetingEvent')->latest()->get();
            $sliders = Slider::latest()->get();
            $municipalDetails = MunicipalDetail::all();

            return view('frontend.website', compact('employees', 'notices', 'newses', 'meetingDecisions', 'sliders', 'municipalDetails'));
        }*/
    }

    public function digitalService()
    {
        return view('frontend.welcome');
    }

    public function notice()
    {
        $notices = Notice::where('type', 'Notice')->orderBy('date')->get();

        return view('frontend.static.notice.index', compact('notices'));
    }

    public function singleNotice(Notice $notice)
    {
        $notice->load('files');

        return view('frontend.static.notice.single-notice', compact('notice'));
    }

    public function contact()
    {
        return view('frontend.static.contact.index');
    }

    public function introduction()
    {
        return view('frontend.static.introduction');
    }

    public function category(): void
    {
        //        return view('frontend.static.category.category');
    }

    public function representative()
    {
        return view('frontend.static.representative.index');
    }

    public function audio()
    {
        return view('frontend.static.gallery.audio.audio');
    }

    public function photo()
    {
        return view('frontend.static.gallery.photo.photo');
    }

    public function single_photo()
    {
        return view('frontend.static.gallery.photo.single-photo');
    }

    public function video()
    {
        return view('frontend.static.gallery.video.video');
    }

    public function employee()
    {
        return view('frontend.static.employee.index');
    }

    public function aboutUs()
    {
        return view('frontend.static.about_us');
    }

    public function org()
    {
        return view('frontend.static.org.org');
    }

    public function executive()
    {
        return view('frontend.static.executive-board.index');
    }

    public function single_executive(): void
    {
        //        return view('frontend.static.executive-board.single-executive-board');
    }

    public function service_details(): void
    {
        //        return view('frontend.static.chat.service');
    }

    public function seniorCitizenDetailQrcode(SeniorCitizenDetail $seniorCitizenDetail)
    {
        $seniorCitizenDetail->load('fingerPrints', 'employeeSignature', 'province', 'district', 'localBody');
        $officeHeaders = OfficeHeader::get();
        $todayDate = $this->get_today_nepali_date();
        return view('frontend.seniorCitizenprint', compact('todayDate', 'seniorCitizenDetail', 'officeHeaders'));
    }

    public function disabilityIdentityCardQrcode(DisabilityIdentityCard $disabilityIdentityCard)
    {
        $disabilityIdentityCard->load('fingerPrints', 'employeeSignature', 'disabilityType', 'governmentalDisabilityType', 'permanentProvince', 'permanentDistrict', 'permanentLocalBody');
        $officeHeaders = OfficeHeader::get();
        $todayDate = $this->get_today_nepali_date();
        return view('frontend.disabilityPrint', compact('todayDate', 'disabilityIdentityCard', 'officeHeaders'));
    }

    public function wardIndex($ward)
    {
        return view('frontend.wardIndex', compact('ward'));
    }


}
