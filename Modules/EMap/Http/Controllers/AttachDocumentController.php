<?php

namespace Modules\EMap\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\FormStoreNotification;
use App\Notifications\PaymentStoreNotification;
use App\Notifications\StepNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Modules\EMap\Entities\AttachDocument;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Entities\Form;
use Modules\EMap\Entities\AppliedDocument;
use Modules\EMap\Entities\PaymentStore;
use Modules\EMap\Entities\PaymentStoreStatus;
use Modules\EMap\Enums\DocumentStatusEnum;
use Modules\EMap\Entities\Organization;
use Modules\EMap\Entities\FormStore;
use Modules\EMap\Entities\FormStoreStatus;
use Modules\EMap\Entities\AppliedDocumentStatus;
use Modules\EMap\Entities\FormDataType;
use Modules\EMap\Enums\FormTypeEnum;
use Modules\EMap\Enums\PostsEnum;

class AttachDocumentController extends Controller
{
    public function store(Request $request, MapApply $mapApply, Form $form, FormDataType $formDataType)
    {

        $form->load('group.users');
        if ($formDataType->type == FormTypeEnum::FILE) {
            $data = $request->validate([
                'documents' => ['array', 'required'],
                'documents.*' => ['file']
            ]);

            DB::transaction(function () use ($request, $mapApply, $form, $data, $formDataType) {
                $appliedDocument = $mapApply->appliedDocuments()->create([
                    'form_id' => $form->id,
                    'status' => DocumentStatusEnum::PENDING->value,
                    'uploaded_by_type' => Organization::class,
                    'uploaded_by_id' => auth('organization')->user()->id,
                    'form_data_type' => FormDataType::class,
                    'form_data_id' => $formDataType->id
                ]);
                foreach ($data['documents'] as $file) {
                    $appliedDocument->appliedMapFiles()->create([
                        "map_apply_id" => $mapApply->id,
                        "document" => $file->store('appliedDocument', 'public'),
                    ]);
                }

                Notification::send($form->group->users, new StepNotification($mapApply, $form, $formDataType, $appliedDocument));
            });

            toast('फाईल सफलतापूर्वक थपियो', 'success');
        } elseif ($formDataType->type == FormTypeEnum::FORM) {
            $data = $request->validate([
                'data' => ['required'],
            ]);

            DB::transaction(function () use ($request, $mapApply, $form, $data, $formDataType) {
                $formStore =   $mapApply->formStores()->create([
                    'form_id' => $form->id,
                    'status' => DocumentStatusEnum::PENDING->value,
                    'uploaded_by_type' => Organization::class,
                    'uploaded_by_id' => auth('organization')->user()->id,
                    'form_data_type' => FormDataType::class,
                    'form_data_id' => $formDataType->id,
                    'data' => $data['data'],
                    'fields' => $form->fields ?? ''
                ]);
                Notification::send($form->group->users, new FormStoreNotification($mapApply, $form, $formDataType, $formStore));
            });
            toast('फारम सफलतापूर्वक थपियो', 'success');
        } elseif ($formDataType->type == FormTypeEnum::PAYMENT) {
            $data = $request->validate([
                'bill' => ['required', 'file'],
                'amount' => ['required', 'numeric'],
            ]);
            DB::transaction(function () use ($request, $mapApply, $form, $data, $formDataType) {
                $paymentStore =  $mapApply->paymentStores()->create([
                    'form_id' => $form->id,
                    'status' => DocumentStatusEnum::PENDING->value,
                    'uploaded_by_type' => Organization::class,
                    'uploaded_by_id' => auth('organization')->user()->id,
                    'bill' => $data['bill']->store('appliedDocument', 'public'),
                    'amount' => $data['amount'],
                    'form_data_type' => FormDataType::class,
                    'form_data_id' => $formDataType->id
                ]);
                Notification::send($form->group->users, new PaymentStoreNotification($mapApply, $form, $formDataType, $paymentStore));
            });
            toast('फारम सफलतापूर्वक थपियो', 'success');
        }
        return redirect(route('organization.admin.formDetail', [$mapApply, $form]));
    }


    public function documentDetail(AppliedDocument $appliedDocument)
    {
        $appliedDocument->load('appliedMapFiles', 'form');
        return view('emap::organization.attach-document.documentDetail', compact('appliedDocument'));
    }


    public function formStoreDetail(FormStore $formStore)
    {
        $formStore->load('formStoreStatuses');
        return view('emap::organization.attach-document.formStoreDetail', compact('formStore'));
    }

    public function printTemplate(MapApply $mapApply, FormDataType $formDataType)
    {

        $formDataType->load('model');
        $mapApply->load(
            'landDetail',
            'landOwner',
            'houseOwner',
            'fourForts',
            'applicantDetail.citizenshipIssueDistrict',
            'criteriaDetails',
            'buildingDetails',
            'designerDetails'
        );
        $data = Str::replace($this->getReplaceData(), $this->getEmapTemplateData($mapApply), $formDataType->model->data);

        return response()->json([
            'view' => (string)View::make('emap::organization.attach-document.print', compact('data')),
        ]);
    }

    public function update(Request $request, MapApply $mapApply, Form $form, FormDataType $formDataType, $id)
    {
        $form->load('group.users');
        if ($formDataType->type == FormTypeEnum::FILE) {
            $data = $request->validate([
                'documents' => ['array', 'required'],
                'documents.*' => ['file']
            ]);
            DB::transaction(function () use ($request, $mapApply, $formDataType, $form, $data, $id) {
                $appliedDocument = AppliedDocument::find($id);
                if ($appliedDocument->status == DocumentStatusEnum::PENDING) {
                    foreach ($appliedDocument->appliedMapFiles as $existingFile) {
                        $existingFile->forceDelete();
                        foreach ($data['documents'] as $file) {
                            $appliedDocument->appliedMapFiles()->create([
                                "map_apply_id" => $mapApply->id,
                                "document" => $file->store('appliedDocument', 'public'),
                            ]);
                        }
                    }
                    toast('फाईल सफलतापूर्वक थपियो', 'success');
                } elseif ($appliedDocument->status == DocumentStatusEnum::REVIEW) {
                    toast('Document On Review You Cannot Change Document', 'error');
                } elseif ($appliedDocument->status == DocumentStatusEnum::APPROVED) {
                    toast('Document Is Already Approved', 'warning');
                } else {
                    $appliedDocument->update([
                        'status' => DocumentStatusEnum::PENDING->value
                    ]);
                    $appliedDocumentStatus = AppliedDocumentStatus::create([
                        "applied_document_id" => $appliedDocument->id,
                        "status" => DocumentStatusEnum::PENDING->value
                    ]);
                    foreach ($appliedDocument->appliedMapFiles as $existingFile) {
                        $existingFile->forceDelete();
                    }
                    foreach ($data['documents'] as $file) {
                        $newAppliedDocuments = $appliedDocument->appliedMapFiles()->create([
                            "map_apply_id" => $mapApply->id,
                            "document" => $file->store('appliedDocument', 'public'),
                        ]);

                        $appliedDocumentStatus->appliedMapFiles()->create([
                            "map_apply_id" => $mapApply->id,
                            "document" => $newAppliedDocuments->document,
                        ]);
                    }
                    toast('फाईल सफलतापूर्वक थपियो', 'success');
                }

                Notification::send($form->group->users, new StepNotification($mapApply, $form, $formDataType, $appliedDocument));
            });
        } elseif ($formDataType->type == FormTypeEnum::FORM) {
            $data = $request->validate([
                'data' => ['required'],
            ]);
            DB::transaction(function () use ($request, $mapApply, $formDataType, $form, $data, $id) {
                $formStore = FormStore::find($id);
                if ($formStore->status == DocumentStatusEnum::PENDING) {
                    $formStore->update([
                        'data' => $data['data'],
                        'document'=>null
                    ]);
                    if($formStore->formStoreStatuses->count() > 0)
                    {
                        FormStoreStatus::where('form_store_id', $formStore->id)
                            ->orderBy('id', 'desc')
                            ->first()?->update([
                                'document' => null
                            ]);
                    }
                    toast('फाईल सफलतापूर्वक थपियो', 'success');
                } elseif ($formStore->status == DocumentStatusEnum::REVIEW) {
                    toast('Form Data On Review You Cannot Change Data', 'error');
                } elseif ($formStore->status == DocumentStatusEnum::APPROVED) {
                    toast('Form Data Is Already Approved', 'warning');
                } else {
                    FormStoreStatus::create([
                        "form_store_id" => $formStore->id,
                        "status" => DocumentStatusEnum::PENDING->value,
                        "data" => $data['data'],
                        "fields" => $formStore->fields,
                    ]);

                    $formStore->update([
                        "status" => DocumentStatusEnum::PENDING->value,
                        'data' => $data['data'],
                        'document'=> null
                    ]);
                    toast('फाईल सफलतापूर्वक थपियो', 'success');
                }
                Notification::send($form->group->users, new FormStoreNotification($mapApply, $form, $formDataType, $formStore));
            });
            toast('फारम सफलतापूर्वक थपियो', 'success');
        } elseif ($formDataType->type == FormTypeEnum::PAYMENT) {
            $data = $request->validate([
                'bill' => ['nullable', 'file'],
                'amount' => ['required', 'numeric'],
            ]);
            DB::transaction(function () use ($request, $mapApply, $formDataType, $form, $data, $id) {
                $paymentStore = PaymentStore::find($id);
                PaymentStoreStatus::create([
                    "payment_store_id" => $paymentStore->id,
                    "status" => DocumentStatusEnum::PENDING->value,
                    'bill' => $paymentStore->bill,
                    'amount' => $paymentStore->amount,
                ]);
                $paymentStore->update([
                    'bill' => (array_key_exists('bill', $data) && !empty($data['bill'])) ? $data['bill']->store('appliedDocument', 'public') : $paymentStore->bill,
                    'amount' => $data['amount'],
                ]);
                Notification::send($form->group->users, new PaymentStoreNotification($mapApply, $form, $formDataType, $paymentStore));
            });
            toast('फारम सफलतापूर्वक थपियो', 'success');
        }
        return redirect(route('organization.admin.formDetail', [$mapApply, $form]));
    }

    public function index(MapApply $mapApply)
    {
        $mapApply->load('attachDocument');
        return view('emap::organization.organizationDocument.index', compact('mapApply'));
    }

    public function storeOrganizationDocument(Request $request, MapApply $mapApply)
    {

        $attachdocument = AttachDocument::where('map_apply_id', $mapApply->id)->first() ?? null;
        if (!$attachdocument) {
            $data = $request->validate([
                'land_owner_document' => ['required', 'mimes:png,jpg,jpeg,pdf'],
                'land_revenue_document' => ['required', 'mimes:png,jpg,jpeg,pdf'],
                'land_owner_citizenship' => ['required', 'mimes:png,jpg,jpeg,pdf'],
                'blue_print' => ['required', 'mimes:png,jpg,jpeg,pdf'],
                'pass_document' => ['required', 'mimes:png,jpg,jpeg,pdf'],
                'designer_document' => ['required', 'mimes:png,jpg,jpeg,pdf'],
                'permission_document' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
                'inheritance_document' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
                'analysis_document' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
            ]);
        } else {
            $data = $request->validate([
                'land_owner_document' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
                'land_revenue_document' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
                'land_owner_citizenship' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
                'blue_print' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
                'pass_document' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
                'designer_document' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
                'permission_document' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
                'inheritance_document' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
                'analysis_document' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
            ]);
        }

        if ($request->hasFile('land_owner_document') && !empty($mapApply->attachDocument->land_owner_document)) {
            $this->deleteFile($mapApply->attachDocument->getRawOriginal('land_owner_document'));
        }

        if ($request->hasFile('land_revenue_document') && !empty($mapApply->attachDocument->land_revenue_document)) {
            $this->deleteFile($mapApply->attachDocument->getRawOriginal('land_revenue_document'));
        }

        if ($request->hasFile('land_owner_citizenship') && !empty($mapApply->attachDocument->land_owner_citizenship)) {
            $this->deleteFile($mapApply->attachDocument->getRawOriginal('land_owner_citizenship'));
        }

        if ($request->hasFile('blue_print') && !empty($mapApply->attachDocument->blue_print)) {
            $this->deleteFile($mapApply->attachDocument->getRawOriginal('blue_print'));
        }

        if ($request->hasFile('pass_document') && !empty($mapApply->attachDocument->pass_document)) {
            $this->deleteFile($mapApply->attachDocument->getRawOriginal('pass_document'));
        }

        if ($request->hasFile('designer_document') && !empty($mapApply->attachDocument->designer_document)) {
            $this->deleteFile($mapApply->attachDocument->getRawOriginal('designer_document'));
        }

        if ($request->hasFile('permission_document') && !empty($mapApply->attachDocument->permission_document)) {
            $this->deleteFile($mapApply->attachDocument->getRawOriginal('permission_document'));
        }

        if ($request->hasFile('inheritance_document') && !empty($mapApply->attachDocument->inheritance_document)) {
            $this->deleteFile($mapApply->attachDocument->getRawOriginal('inheritance_document'));
        }
        AttachDocument::updateOrCreate([
            'map_apply_id' => $mapApply->id
        ], $data);
        toast('File added successfully', 'success');
        return back();
    }

    protected function getEmapTemplateData($mapApply)
    {
        $designerDetail = $mapApply->designerDetails->where('post', PostsEnum::DESIGNER)->first();
        $supervisorDetail = $mapApply->designerDetails->where('post', PostsEnum::SUPERVISOR)->first();
        $contractorDetail = $mapApply->designerDetails->where('post', PostsEnum::CONTRACTOR)->first();

        return [

            //header
            letterHead(),
            letterHead('letter_head'),

            //mapApply
            $mapApply->registration_no ?? '',
            $mapApply->registration_date ?? '',
            $mapApply->construction_type?->label() ?? '',
            $mapApply->usage?->label() ?? '',
            $mapApply->building_category?->label() ?? '',
            $mapApply->structureType->title ?? '',
            $mapApply->current_storey ?? '',
            $mapApply->future_storey ?? '',
            $mapApply->area_of_plinth ?? '',
            $mapApply->length ?? '',
            $mapApply->breadth ?? '',
            $mapApply->height ?? '',
            //landDetail
            $mapApply->landDetail?->landUseArea?->title ?? '',
            $mapApply->landDetail->ward_no ?? '',
            $mapApply->landDetail->former_ward_no ?? '',
            $mapApply->landDetail->tole ?? '',
            $mapApply->landDetail->street_code_no ?? '',
            $mapApply->landDetail->plot_no ?? '',
            $mapApply->landDetail->area ?? '',
            $mapApply->landDetail->percentage_of_area_covered_by_building ?? '',

            //landowner

            $mapApply->landOwner->land_owner_type->label() ?? '',
            $mapApply->landOwner->name ?? '',
            $mapApply->landOwner->phone ?? '',
            $mapApply->landOwner->father_name ?? '',
            $mapApply->landOwner->grandfather_name ?? '',
            $mapApply->landOwner->citizenshipIssueDistrict->district ?? '',
            $mapApply->landOwner->citizenship_no ?? '',
            $mapApply->landOwner->citizenship_issue_date ?? '',
            $mapApply->landOwner->address ?? '',
            $mapApply->landOwner->local_body ?? '',
            $mapApply->landOwner->ward_no ?? '',

            //houseOwner

            $mapApply->houseOwner->name ?? '',
            $mapApply->houseOwner->phone ?? '',
            $mapApply->houseOwner->father_name ?? '',
            $mapApply->houseOwner->grandfather_name ?? '',
            $mapApply->houseOwner->citizenshipIssueDistrict->district ?? '',
            $mapApply->houseOwner->citizenship_no ?? '',
            $mapApply->houseOwner->citizenship_issue_date ?? '',
            $mapApply->houseOwner->address ?? '',
            $mapApply->houseOwner->local_body ?? '',
            $mapApply->houseOwner->ward_no ?? '',

            //FourForts
            (string)View::make('emap::inc.four_forts_table', [
                'fourForts' => $mapApply->fourForts,
            ]),

            //applicantDetail
            $mapApply->applicantDetail->applicant_type->label() ?? '',
            $mapApply->applicantDetail->relation_with_owner->label() ?? '',
            $mapApply->applicantDetail->name ?? '',
            $mapApply->applicantDetail->phone ?? '',
            $mapApply->applicantDetail->father_name ?? '',
            $mapApply->applicantDetail->citizenshipIssueDistrict->district ?? '',
            $mapApply->applicantDetail->citizenship_no ?? '',
            $mapApply->applicantDetail->citizenship_issue_date ?? '',
            $mapApply->applicantDetail->signature_url ?? '',

            //criteria detail

            (string)View::make('emap::inc.criteria_details', [
                'criteriaDetails' => $mapApply->criteriaDetails,
            ]),
            //BuildingDetails

            (string)View::make('emap::inc.building_details', [
                'buildingDetails' => $mapApply->buildingDetails,
            ]),

            //DesignerDetails

            $designerDetail->name ?? '',
            $designerDetail->father_name ?? '',
            $designerDetail->phone ?? '',
            $designerDetail->address ?? '',
            $designerDetail->local_body ?? '',
            $designerDetail->ward_no ?? '',
            $designerDetail->nec_council_no ?? '',
            $designerDetail->local_body_registration_no ?? '',
            $designerDetail->consulting_firm_name ?? '',

            //supervisorDetails

            $supervisorDetail->name ?? '',
            $supervisorDetail->father_name ?? '',
            $supervisorDetail->phone ?? '',
            $supervisorDetail->address ?? '',
            $supervisorDetail->local_body ?? '',
            $supervisorDetail->ward_no ?? '',
            $supervisorDetail->nec_council_no ?? '',
            $supervisorDetail->local_body_registration_no ?? '',
            $supervisorDetail->consulting_firm_name ?? '',

            //ContractorDetails

            $contractorDetail->name ?? '',
            $contractorDetail->father_name ?? '',
            $contractorDetail->phone ?? '',
            $contractorDetail->address ?? '',
            $contractorDetail->local_body ?? '',
            $contractorDetail->ward_no ?? '',
            $contractorDetail->nec_council_no ?? '',
            $contractorDetail->local_body_registration_no ?? '',
            $contractorDetail->consulting_firm_name ?? '',
        ];
    }

    private function getReplaceData()
    {
        return [
            //header

            '[@header]',
            '[@letter_head]',
            //mapApply

            '[@registration_no]',
            '[@registration_date]',
            '[@construction_type]',
            '[@usage]',
            '[@building_category]',
            '[@structureType]',
            '[@current_storey]',
            '[@future_storey]',
            '[@area_of_plinth]',
            '[@length]',
            '[@breadth]',
            '[@height]',
            //landDetail
            '[@landDetail.land_use_area.title]',
            '[@landDetail.ward_no]',
            '[@landDetail.former_ward_no]',
            '[@landDetail.tole]',
            '[@landDetail.street_code_no]',
            '[@landDetail.plot_no]',
            '[@landDetail.area]',
            '[@landDetail.percentage_of_area_covered_by_building]',

            //landOwner
            '[@landOwner.land_owner_type]',
            '[@landOwner.name]',
            '[@landOwner.phone]',
            '[@landOwner.father_name]',
            '[@landOwner.grandfather_name]',
            '[@landOwner.citizenship_issue_district]',
            '[@landOwner.citizenship_no]',
            '[@landOwner.citizenship_issue_date]',
            '[@landOwner.address]',
            '[@landOwner.local_body]',
            '[@landOwner.ward_no]',

            //houseOwner

            '[@houseOwner.name]',
            '[@houseOwner.phone]',
            '[@houseOwner.father_name]',
            '[@houseOwner.grandfather_name]',
            '[@houseOwner.citizenship_issue_district]',
            '[@houseOwner.citizenship_no]',
            '[@houseOwner.citizenship_issue_date]',
            '[@houseOwner.address]',
            '[@houseOwner.local_body]',
            '[@houseOwner.ward_no]',

            //FourForts

            '[@fourForts]',

            //applicantDetail

            '[@applicantDetail.applicant_type]',
            '[@applicantDetail.relation_with_owner]',
            '[@applicantDetail.name]',
            '[@applicantDetail.phone]',
            '[@applicantDetail.father_name]',
            '[@applicantDetail.citizenship_issue_district]',
            '[@applicantDetail.citizenship_no]',
            '[@applicantDetail.citizenship_issue_date]',
            '[@applicantDetail.signature_url]',

            //criteria detail
            '[@criteriaDetails]',

            //BuildingDetails
            '[@buildingDetails]',

            //DesignerDetails
            '[@designerDetail.name]',
            '[@designerDetail.father_name]',
            '[@designerDetail.phone]',
            '[@designerDetail.address]',
            '[@designerDetail.local_body]',
            '[@designerDetail.ward_no]',
            '[@designerDetail.nec_council_no]',
            '[@designerDetail.local_body_registration_no]',
            '[@designerDetail.consulting_firm_name]',

            //supervisorDetails

            '[@supervisorDetail.name]',
            '[@supervisorDetail.father_name]',
            '[@supervisorDetail.phone]',
            '[@supervisorDetail.address]',
            '[@supervisorDetail.local_body]',
            '[@supervisorDetail.ward_no]',
            '[@supervisorDetail.nec_council_no]',
            '[@supervisorDetail.local_body_registration_no]',
            '[@supervisorDetail.consulting_firm_name]',

            //ContractorDetails

            '[@contractorDetail.name]',
            '[@contractorDetail.father_name]',
            '[@contractorDetail.phone]',
            '[@contractorDetail.address]',
            '[@contractorDetail.local_body]',
            '[@contractorDetail.ward_no]',
            '[@contractorDetail.nec_council_no]',
            '[@contractorDetail.local_body_registration_no]',
            '[@contractorDetail.consulting_firm_name]'
        ];
    }
    public function updateAppliedDocumentStatus(Request $request, AppliedDocument $appliedDocument)
    {
        $this->getStatusValidation($request);
        DB::transaction(function () use ($request, $appliedDocument) {
            $appliedDocument->update([
                'status' => $request->input('status')
            ]);
            $appliedDocument->appliedDocumentStatuses()->create([
                "applied_document_id" => $appliedDocument->id,
                "status" => $request->input('status'),
                "comment" => $request->input('comment'),
            ]);
        });

        toast('स्थिति सफलतापूर्वक परिवर्तन गरियो', 'success');
        return back();
    }

    public function updateFormStoreStatus(Request $request, FormStore $formStore)
    {
        $this->getStatusValidation($request);
        DB::transaction(function () use ($request, $formStore) {
            $formStore->update([
                'status' => $request->input('status')
            ]);
            $formStore->formStoreStatuses()->create([
                "form_store_id" => $formStore->id,
                "status" => $request->input('status'),
                "comment" => $request->input('comment'),
                "data" => $formStore->data,
                "fields" => $formStore->fields
            ]);
        });

        toast('स्थिति सफलतापूर्वक परिवर्तन गरियो', 'success');
        return back();
    }

    public function updatePaymentStoreStatus(Request $request, PaymentStore $paymentStore)
    {
        $this->getStatusValidation($request);

        DB::transaction(function () use ($request, $paymentStore) {
            $paymentStore->update([
                'status' => $request->input('status')
            ]);
            $paymentStore->paymentStoreStatuses()->create([
                "payment_store_id" => $paymentStore->id,
                "status" => $request->input('status'),
                "comment" => $request->input('comment'),
                "bill" => $paymentStore->bill,
                "amount" => $paymentStore->amount
            ]);
        });
        toast('स्थिति सफलतापूर्वक परिवर्तन गरियो', 'success');
        return back();
    }

    public function getStatusValidation($request)
    {
        return $request->validate([
            'status' => ['required', 'string', new Enum(DocumentStatusEnum::class)],
            'comment' => ['required_if:status,' . DocumentStatusEnum::REJECTED->value],
        ]);
    }

    public function formStorePrint(FormDataType $formDataType, FormStore $formStore)
    {
        $formStore->load('form_data.model');
        $formDataType->load('model');
        $template = $formStore->form_data?->model?->template ?? '';

        foreach ($formStore->data as $key => $value) {
            $placeholder = '[@form.' . $key . ']';
            $template = str_replace($placeholder, $value, $template);
        }

        return view('emap::organization.attach-document.form-print', compact('template', 'formDataType','formStore'));
    }

    public function formStoreStatusPrint(FormDataType $formDataType, FormStore $formStore,FormStoreStatus $formStoreStatus)
    {
        $formStore->load('form_data.model');
        $formDataType->load('model');
        $template = $formStore->form_data?->model?->template ?? '';

        foreach ($formStoreStatus->data as $key => $value) {
            $placeholder = '[@form.' . $key . ']';
            $template = str_replace($placeholder, $value, $template);
        }

        return view('emap::organization.attach-document.form-print', compact('template', 'formDataType'));
    }
}
