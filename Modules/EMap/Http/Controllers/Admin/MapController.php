<?php

namespace Modules\EMap\Http\Controllers\Admin;

use App\Enums\ApplicationTypeEnum;
use App\Http\Controllers\Controller;
use App\Notifications\ApplyMapNoticeNotification;
use App\Notifications\MapApplyNotification;
use App\Traits\NepaliDateConverter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Modules\EMap\Entities\ApplyMapNotice;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Enums\ApplicationFormTypeEnum;
use Modules\EMap\Enums\NoticeTypeEnum;
use Illuminate\Database\Eloquent\Builder;
use Modules\EMap\Entities\AttachDocument;

class MapController extends Controller
{
    use NepaliDateConverter;

    public function index(ApplicationFormTypeEnum $applicationFormTypeEnum)
    {
        $this->checkAuthorization('mapApply_access');
        $application_types = collect();

        foreach (ApplicationTypeEnum::cases() as $applicationType) {
            $application_types->push($applicationType->value);
        }

        $maps = MapApply::with(['fiscalYear', 'organization:id,name', 'applyMapNotices', 'landDetail', 'houseOwner'])
            ->sentToAdmin()
            ->isMapVerified($applicationFormTypeEnum)
            ->where(function (Builder $q) {
                if (!is_null(request('search'))) {
                    $q->whereLike(['registration_no', 'unique_id', 'organization.name'], request('search'));
                }
            })
            ->whereHas('landDetail', function (Builder $q) {
                if (!empty(auth()->user()->ward_no)) {
                    $q->where('ward_no', auth()->user()->ward_no);
                }
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);


        return view('emap::admin.map.index', compact('maps', 'application_types', 'applicationFormTypeEnum'));
    }


    public function noticeList(MapApply $mapApply, ApplicationFormTypeEnum $applicationFormTypeEnum): Factory|View|Application
    {
        return view('emap::admin.map.notice-list', compact('mapApply', 'applicationFormTypeEnum'));
    }

    public function register(MapApply $mapApply)
    {
        if (!empty($mapApply->registration_no)) {
            toast('यो नक्सा पहिने नै दर्ता भएको छ', 'success');
            return back();
        }
        $mapApply->update([
            'registration_date' => now(),
            'registration_no' => MapApply::whereFiscalYearId($mapApply->fiscal_year_id)->max('registration_no') + 1,
        ]);
        toast('नक्सा सफलता पुर्वक दर्ता भयो', 'success');
        return back();
    }

    public function show(MapApply $mapApply, ApplicationFormTypeEnum $applicationFormTypeEnum, NoticeTypeEnum $noticeTypeEnum)
    {
        $mapApply->load(['fiscalYear', 'mapRegistration', 'organization.organizationDetail', 'storeyDetails.mapFee', 'landDetail.unit', 'landOwner.citizenshipIssueDistrict', 'houseOwner.citizenshipIssueDistrict', 'fourForts', 'applicantDetail', 'criteriaDetails', 'buildingDetails', 'mapApplyApplications', 'applyMapNotices' => function ($query) {
            $query->latest();
        }]);

        $data = $mapApply->applyMapNotices->where('file_type', $noticeTypeEnum)?->first()->data ?? $mapApply->getSpecificTemplateData($noticeTypeEnum) ?? '';

        $districts = get_districts();

        return view('emap::admin.map.show', compact('mapApply', 'districts', 'applicationFormTypeEnum', 'data', 'noticeTypeEnum'));
    }

    public function mapDetail(MapApply $mapApply, ApplicationFormTypeEnum $applicationFormTypeEnum)
    {
        $mapApply->load('attachDocument', 'structureType', 'storeyDetails.mapFee', 'landDetail', 'landOwner', 'houseOwner', 'fourForts', 'designerDetails', 'applicantDetail', 'criteriaDetails', 'buildingDetails', 'organization.organizationDetail');
        return view('emap::admin.map.mapdetail', compact('mapApply', 'applicationFormTypeEnum'));
    }

    public function reject(Request $request, MapApply $mapApply, NoticeTypeEnum $noticeTypeEnum): Redirector|Application|RedirectResponse
    {
        $this->checkAuthorization('mapApplyNoticeReject_access');

        $data = ApplyMapNotice::where('map_apply_id', $mapApply->id)
            ->where('file_type', $noticeTypeEnum->value)
            ->first();
        if (!empty($request->input('remarks'))) {
            $data->update([
                'type' => 'Reject',
                'rejected_at' => now(),
                'remarks' => $request->input('remarks'),
            ]);
        } else {
            $data->update([
                'type' => 'Accept',
                'rejected_at' => null,
                'remarks' => null,
            ]);
        }

        //        Notification::send($mapApply->organization, new ApplyMapNoticeNotification($data));

        toast('आवेदन सफलतापूर्वक अस्वीकार गरियो', 'success');

        return back();
    }


    public function superstructure(MapApply $mapApply): Factory|View|Application
    {
        $mapApply->load(['landDetail', 'landOwner', 'houseOwner:id,name']);

        return view('emap::admin.notice.superstructure', compact('mapApply'));
    }

    public function getTemplateData(MapApply $mapApply, ApplicationFormTypeEnum $applicationFormTypeEnum, NoticeTypeEnum $noticeTypeEnum)
    {
        $mapApply->load(['applyMapNotices.files', 'applyMapNotices' => function ($q) use ($noticeTypeEnum) {
            $q->where('file_type', $noticeTypeEnum->value)->latest()->first();
        }]);


        return view('emap::admin.map.edit', compact('mapApply', 'noticeTypeEnum', 'applicationFormTypeEnum'));
    }

    public function storeTemplateData(Request $request, MapApply $mapApply, ApplicationFormTypeEnum $applicationFormTypeEnum, NoticeTypeEnum $noticeTypeEnum): RedirectResponse
    {
        $this->checkAuthorization('mapApplyNotice_access');


        $request->validate([
            'data' => ['required'],
            'files' => ['nullable', 'array'],
            'files.*' => ['mimes:jpg,png,jpeg,pdf'],
        ]);

        $mapApplyData = DB::transaction(function () use ($request, $mapApply, $noticeTypeEnum) {
            $mapApplyData = ApplyMapNotice::updateOrCreate(
                [
                    'map_apply_id' => $mapApply->id,
                    'file_type' => $noticeTypeEnum->value,
                ],
                [
                    'data' => $request->input('data'),
                ]
            );

            if (!$mapApplyData->wasChanged()) {
                $mapApplyData->update([
                    'sent_to_admin_at' => now()
                ]);
            }

            if ($request->hasFile('files')) {
                $this->uploadDocuments($request, $mapApplyData);
            }

            return $mapApplyData;
        });

        toast('फाईल सफलता पुर्बक थपियो', 'success');

        return redirect()->route('emap.admin.map.mapApply.show', [$mapApply, $applicationFormTypeEnum, $noticeTypeEnum]);
    }

    private function uploadDocuments($request, $mapApplyData): void
    {
        foreach ($request->file('files') as $document) {
            $mapApplyData->files()->create([
                'file_name' => pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME),
                'extension' => $document->getClientOriginalExtension(),
                'file' => $document->store('emapTemplateFile', 'public'),
            ]);
        }
    }

    public function updateStatus(Request $request, MapApply $mapApply, ApplicationFormTypeEnum $applicationFormTypeEnum)
    {
        $this->checkAuthorization('mapApply_access');
        //        abort_if($mapApply->sent_to_organization == 'Accept', 403);
        DB::transaction(function () use ($request, $mapApply, $applicationFormTypeEnum) {
            $number = MapApply::whereFiscalYearId(\officeSetting()->fiscal_year_id)
                ->max('number') + 1;
            $mapApply->update([
                'sent_to_organization' => $request->input('sent_to_organization')
            ]);
            if ($mapApply->sent_to_organization == 'Reject') {
                $mapApply->update([
                    'sent_to_admin_at' => null
                ]);
            }
            if ($mapApply->sent_to_organization == 'Accept') {
                $mapApply->update([
                    'number' => $number,
                    'file_code' => $this->get_today_nepali_date() . '/' . $mapApply->landDetail?->ward_no . '/' . $number,
                ]);
            }
        });
        Notification::send($mapApply->organization, new MapApplyNotification($mapApply));
        toast(' सफलता पुर्बक आवधिक गरियो', 'success');
        return back();
    }

    public function updateDocumentStatus(Request $request, MapApply $mapApply)
    {
        if ($request->input('land_owner_document_status')) {
            AttachDocument::where('map_apply_id', $mapApply->id)->update([
                'land_owner_document_status' => $request->input('land_owner_document_status')
            ]);
        } elseif ($request->input('land_revenue_document_status')) {
            AttachDocument::where('map_apply_id', $mapApply->id)->update([
                'land_revenue_document_status' => $request->input('land_revenue_document_status')
            ]);
        } elseif ($request->input('land_owner_citizenship_status')) {
            AttachDocument::where('map_apply_id', $mapApply->id)->update([
                'land_owner_citizenship_status' => $request->input('land_owner_citizenship_status')
            ]);
        } elseif ($request->input('blue_print_status')) {
            AttachDocument::where('map_apply_id', $mapApply->id)->update([
                'blue_print_status' => $request->input('blue_print_status')
            ]);
        } elseif ($request->input('pass_document_status')) {
            AttachDocument::where('map_apply_id', $mapApply->id)->update([
                'pass_document_status' => $request->input('pass_document_status')
            ]);
        } elseif ($request->input('designer_document_status')) {
            AttachDocument::where('map_apply_id', $mapApply->id)->update([
                'designer_document_status' => $request->input('designer_document_status')
            ]);
        } elseif ($request->input('permission_document_status')) {
            AttachDocument::where('map_apply_id', $mapApply->id)->update([
                'permission_document_status' => $request->input('permission_document_status')
            ]);
        } elseif ($request->input('inheritance_document_status')) {
            AttachDocument::where('map_apply_id', $mapApply->id)->update([
                'inheritance_document_status' => $request->input('inheritance_document_status')
            ]);
        } elseif ($request->input('analysis_document_status')) {
            AttachDocument::where('map_apply_id', $mapApply->id)->update([
                'analysis_document_status' => $request->input('analysis_document_status')
            ]);
        }
        toast(' सफलता पुर्बक आवधिक गरियो', 'success');
        return back();
    }
}
