<?php

namespace Modules\EMap\Http\Controllers;

use App\Helper\SMS\AakashSms;
use App\Http\Controllers\Controller;
use App\Mail\OrganizationRegistered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Modules\EMap\Entities\Organization;

class OrganizationController extends Controller
{
    public function index()
    {
        abort_if(
            Gate::denies('organization_access'),
            403,
            'You are not allowed to employee access'
        );
        $organizations = Organization::with('organizationDetail')->latest()->get();

        return view('emap::admin.organization.index', compact('organizations', 'organization_count'));
    }

    public function updateLoginStatus(Organization $organization)
    {
        if (Gate::denies('organization_edit')) {
            abort(403, 'You are not allowed to edit this organization');
        }

        DB::transaction(function () use ($organization) {
            $organization->update([
                'is_active' => !$organization->is_active
            ]);

            if (empty($organization->password) && $organization->is_active) {
                $url = URL::signedRoute('organization.invitation', $organization);
                (new AakashSms())->sendTextSMS($organization->phone, "Hello Text");
//                Mail::to($organization->email)->send(new OrganizationRegistered($organization, $url));
            }
        });

        return back();
    }

    public function show(Organization $organization)
    {
        abort_if(
            Gate::denies('organization_access'),
            403,
            'You are not allowed to employee access'
        );
        $organization->load(['userDetail.citizenshipIssuedDistrict',
            'userDetail.permanentLocalBody',
            'userDetail.permanentDistrict',
            'userDetail.permanentProvince',
            'userDetail.temporaryLocalBody',
            'userDetail.temporaryDistrict',
            'userDetail.temporaryProvince',
        ]);
    }

    public function destroy(Organization $organization)
    {
        abort_if(
            Gate::denies('organization_delete'),
            403,
            'You are not allowed to employee access'
        );
        $organization->delete();
        toast(' संगठन सफलतापूर्वक मेटाइयो', 'success');
        return back();
    }
}
