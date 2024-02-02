<?php

namespace Modules\EMap\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\FormStoreNotification;
use App\Notifications\PaymentStoreNotification;
use App\Notifications\StepNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules\Enum;
use Modules\EMap\Entities\AppliedDocument;
use Modules\EMap\Entities\AppliedDocumentStatus;
use Modules\EMap\Entities\Form;
use Modules\EMap\Entities\FormDataType;
use Modules\EMap\Entities\FormStore;
use Modules\EMap\Entities\FormStoreStatus;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Entities\Organization;
use Modules\EMap\Entities\PaymentStore;
use Modules\EMap\Entities\PaymentStoreStatus;
use Modules\EMap\Enums\DocumentStatusEnum;
use Modules\EMap\Enums\FormTypeEnum;

class AdminStepController extends Controller
{
    public function formList(MapApply $mapApply)
    {

        $mapApply->load('houseOwner');

        $documentTypeModels = collect([AppliedDocument::class,FormStore::class,PaymentStore::class]);

        $documents = collect([]);

        foreach($documentTypeModels as $documentModel) {
            $typeDocuments = $documentModel::select('id', 'status', 'form_id')->where('map_apply_id', $mapApply->id)->get();
            foreach($typeDocuments as $document) {
                $documents->push([
                    'document_type' => class_basename($documentModel),
                    'form_id' => $document->form_id,
                    'status' => $document->status?->value
                ]);
            }

        }

        $order = 0;
        $allApproved = true;
        $forms = Form::withCount('formDataTypes')
            ->orderBy('order')
            ->get()->map(function ($form, $key) use ($documents, &$order, &$allApproved) {
                $status = $documents->where('form_id', $form->id)->pluck('status');

                if($allApproved && $status->count() == $form->form_data_types_count && $status->every(fn ($s) => $s == DocumentStatusEnum::APPROVED->value)) {
                    $order = $form->order + 1;
                } elseif($key == 0) {
                    $order = $form->order;
                    $allApproved = false;

                } else {
                    $allApproved = false;
                }
                if($allApproved) {
                    $mapStatus = DocumentStatusEnum::APPROVED;
                } elseif ($status->contains(DocumentStatusEnum::REJECTED->value)) {
                    $mapStatus = DocumentStatusEnum::REJECTED;
                } elseif ($status->count() > 0) {
                    $mapStatus = DocumentStatusEnum::PENDING;
                } else {
                    $mapStatus = DocumentStatusEnum::NOT_APPLIED;
                }
                $form->map_status = $mapStatus;
                return $form;
            });
//        $MapGroups = DB::table('map_pass_group_user')->where('user_id', auth()->user()->id)->first() ?? null;

        return view('emap::admin.step.formList', compact('mapApply', 'forms','order'));
    }

    public function viewDetail(MapApply $mapApply, Form $form)
    {

        $mapApply->load('houseOwner');
        $form->load('formDataTypes.model', 'formDataTypes.appliedDocuments.appliedDocumentStatuses', 'formDataTypes.formStores.formStoreStatuses', 'group');
        $checkUser =  $form->group->users->pluck('id')->contains(auth()->user()->id);
        $MapGroups = DB::table('map_pass_group_user')->where('user_id', auth()->user()->id)->first() ?? null;
        $ward_no =  $MapGroups ? explode(',', $MapGroups?->ward_no ?? '') : [];
        $checkAuthorization = in_array($mapApply->landDetail?->ward_no, $ward_no);


        return view('emap::admin.step.formDetail', compact('mapApply', 'form', 'checkAuthorization'));
    }

    public function fillDetail(MapApply $mapApply, Form $form)
    {
        $form->load('formDataTypes.model', 'formDataTypes.appliedDocuments', 'formDataTypes.appliedDocuments.appliedDocumentStatuses', 'formDataTypes.formStores', 'formDataTypes.formStores.formStoreStatuses');
        return view('emap::admin.step.formFill', compact('mapApply', 'form'));
    }

    public function updateAppliedDocumentStatus(Request $request, MapApply $mapApply, Form $form, FormDataType $formDataType, AppliedDocument $appliedDocument)
    {
        $lastStep = Form::orderBy('order', 'desc')->first()?->order ?? null;
        $this->getStatusValidation($request);
        DB::transaction(function () use ($request, $mapApply, $form, $formDataType, $appliedDocument, $lastStep) {
            if ($lastStep == $form->order) {
                $appliedDocumentStatus = AppliedDocument::where('id', '!=', $appliedDocument->id)
                    ->where('map_apply_id', $mapApply->id)
                    ->where('form_id', $form->id)
                    ->pluck('status');
                $formStoreStatus = FormStore::where('map_apply_id', $mapApply->id)
                    ->where('form_id', $form->id)
                    ->pluck('status');
                $paymentStoreStatus = PaymentStore::where('map_apply_id', $mapApply->id)
                    ->where('form_id', $form->id)
                    ->pluck('status');

                if (
                    $formStoreStatus->every(fn ($status) => $status->value == DocumentStatusEnum::APPROVED->value) &&
                    $paymentStoreStatus->every(fn ($status) => $status->value == DocumentStatusEnum::APPROVED->value) &&
                    $request->input('status') == DocumentStatusEnum::APPROVED->value
                ) {
                    if ($appliedDocumentStatus->isEmpty()) {
                        $mapApply->update([
                            'sent_to_organization' => 'done'
                        ]);
                    } else {
                        if ($appliedDocumentStatus->every(fn ($status) => $status->value == DocumentStatusEnum::APPROVED->value)) {
                            $mapApply->update([
                                'sent_to_organization' => 'done'
                            ]);
                        }
                    }
                }
            } else {
                if ($request->input('status') == DocumentStatusEnum::APPROVED->value) {
                    $mapApply->update([
                        'sent_to_organization' => 'processing'
                    ]);
                }
            }

            if ($request->input('status') == DocumentStatusEnum::PENDING->value) {
                toast('Updated New Status', 'warning');
            } elseif ($request->input('status') == DocumentStatusEnum::REVIEW->value) {
                $appliedDocument->update([
                    'status' => $request->input('status')
                ]);
                AppliedDocumentStatus::where('applied_document_id', $appliedDocument->id)
                    ->orderBy('id', 'desc')
                    ->first()?->update([
                        'status' => $request->input('status')
                    ]);
                toast('स्थिति सफलतापूर्वक परिवर्तन गरियो', 'success');
            } elseif ($request->input('status') == DocumentStatusEnum::APPROVED->value) {
                if ($appliedDocument->status != DocumentStatusEnum::APPROVED) {
                    $appliedDocument->update([
                        'status' => $request->input('status')
                    ]);
                    AppliedDocumentStatus::where('applied_document_id', $appliedDocument->id)
                        ->orderBy('id', 'desc')
                        ->first()?->update([
                            'status' => $request->input('status')
                        ]);
                    toast('स्थिति सफलतापूर्वक परिवर्तन गरियो', 'success');
                }
            } else {
                $appliedDocument->update([
                    'status' => $request->input('status')
                ]);
                $appliedDocumentStatusData = $appliedDocument->appliedDocumentStatuses()->create([
                    "applied_document_id" => $appliedDocument->id,
                    "status" => $request->input('status'),
                    "comment" => $request->input('comment'),
                ]);
                foreach ($appliedDocument->appliedMapFiles as $existingFile) {
                    $appliedDocumentStatusData->appliedMapFiles()->create([
                        "map_apply_id" => $mapApply->id,
                        "document" => $existingFile->document,
                    ]);
                }
                toast('स्थिति सफलतापूर्वक परिवर्तन गरियो', 'success');
            }
            Notification::send($mapApply->organization, new StepNotification($mapApply, $form, $formDataType, $appliedDocument));
        });
        return back();
    }

    public function updateFormStoreStatus(Request $request, MapApply $mapApply, Form $form, FormDataType $formDataType, FormStore $formStore)
    {
        $this->getStatusValidation($request);
        $lastStep = Form::orderBy('order', 'desc')->first()?->order ?? null;
        DB::transaction(function () use ($request, $mapApply, $form, $formDataType, $formStore, $lastStep) {

            if ($lastStep == $form->order) {
                $appliedDocumentStatus = AppliedDocument::where('map_apply_id', $mapApply->id)
                    ->where('form_id', $form->id)
                    ->pluck('status');
                $formStoreStatus = FormStore::where('id', '!=', $formStore->id)
                    ->where('map_apply_id', $mapApply->id)
                    ->where('form_id', $form->id)
                    ->pluck('status');
                $paymentStoreStatus = PaymentStore::where('map_apply_id', $mapApply->id)
                    ->where('form_id', $form->id)
                    ->pluck('status');
                if (
                    $appliedDocumentStatus->every(fn ($status) => $status->value == DocumentStatusEnum::APPROVED->value) &&
                    $paymentStoreStatus->every(fn ($status) => $status->value == DocumentStatusEnum::APPROVED->value) &&
                    $request->input('status') == DocumentStatusEnum::APPROVED->value
                ) {
                    if ($formStoreStatus->isEmpty()) {
                        $mapApply->update([
                            'sent_to_organization' => 'done'
                        ]);
                    } else {
                        if ($formStoreStatus->every(fn ($status) => $status->value == DocumentStatusEnum::APPROVED->value)) {
                            $mapApply->update([
                                'sent_to_organization' => 'done'
                            ]);
                        }
                    }
                }
            } else {
                if ($request->input('status') == DocumentStatusEnum::APPROVED->value) {
                    $mapApply->update([
                        'sent_to_organization' => 'processing'
                    ]);
                }
            }

            if ($request->input('status') == DocumentStatusEnum::PENDING->value) {
                toast('Updated New Status', 'warning');
            } elseif ($request->input('status') == DocumentStatusEnum::REVIEW->value) {
                $formStore->update([
                    'status' => $request->input('status')
                ]);
                FormStoreStatus::where('form_store_id', $formStore->id)
                    ->orderBy('id', 'desc')
                    ->first()?->update([
                        'status' => $request->input('status')
                    ]);
                toast('स्थिति सफलतापूर्वक परिवर्तन गरियो', 'success');
            } elseif ($request->input('status') == DocumentStatusEnum::APPROVED->value) {
                if ($formStore->status != DocumentStatusEnum::APPROVED) {
                    $formStore->update([
                        'status' => $request->input('status')
                    ]);
                    FormStoreStatus::where('form_store_id', $formStore->id)
                        ->orderBy('id', 'desc')
                        ->first()?->update([
                            'status' => $request->input('status')
                        ]);
                    toast('स्थिति सफलतापूर्वक परिवर्तन गरियो', 'success');
                }
            } else {
                $formStore->update([
                    'status' => $request->input('status')
                ]);
                 $formStore->formStoreStatuses()->create([
                    "form_store_id" => $formStore->id,
                    "status" => $request->input('status'),
                    "comment" => $request->input('comment'),
                    "data" => $formStore->data,
                    "fields" => $formStore->fields,
                     "document"=>$formStore->document
                ]);

                toast('स्थिति सफलतापूर्वक परिवर्तन गरियो', 'success');
            }
            Notification::send($mapApply->organization, new FormStoreNotification($mapApply, $form, $formDataType, $formStore));
        });

        toast('स्थिति सफलतापूर्वक परिवर्तन गरियो', 'success');
        return back();
    }

    public function updatePaymentStoreStatus(Request $request, MapApply $mapApply, Form $form, FormDataType $formDataType, PaymentStore $paymentStore)
    {
        $this->getStatusValidation($request);
        $lastStep = Form::orderBy('order', 'desc')->first()?->order ?? null;
        DB::transaction(function () use ($request, $mapApply, $form, $formDataType, $paymentStore, $lastStep) {

            if ($lastStep == $form->order) {
                $appliedDocumentStatus = AppliedDocument::where('map_apply_id', $mapApply->id)
                    ->where('form_id', $form->id)
                    ->pluck('status');
                $formStoreStatus = FormStore::where('map_apply_id', $mapApply->id)
                    ->where('form_id', $form->id)
                    ->pluck('status');
                $paymentStoreStatus = PaymentStore::where('id', '!=', $paymentStore->id)
                    ->where('map_apply_id', $mapApply->id)
                    ->where('form_id', $form->id)
                    ->pluck('status');
                if (
                    $appliedDocumentStatus->every(fn ($status) => $status->value == DocumentStatusEnum::APPROVED->value) &&
                    $formStoreStatus->every(fn ($status) => $status->value == DocumentStatusEnum::APPROVED->value) &&
                    $request->input('status') == DocumentStatusEnum::APPROVED->value
                ) {
                    if ($paymentStoreStatus->isEmpty()) {
                        $mapApply->update([
                            'sent_to_organization' => 'done'
                        ]);
                    } else {
                        if ($paymentStoreStatus->every(fn ($status) => $status->value == DocumentStatusEnum::APPROVED->value)) {
                            $mapApply->update([
                                'sent_to_organization' => 'done'
                            ]);
                        }
                    }
                }
            } else {
                if ($request->input('status') == DocumentStatusEnum::APPROVED->value) {
                    $mapApply->update([
                        'sent_to_organization' => 'processing'
                    ]);
                }
            }

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
            Notification::send($mapApply->organization, new PaymentStoreNotification($mapApply, $form, $formDataType, $paymentStore));
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

    public function rejectMap(Request $request, MapApply $mapApply)
    {
        $request->validate([
            'comment' => ['required'],
        ]);
        $mapApply->update([
            'sent_to_organization' => 'rejected',
            'comment' => $request->input('comment')

        ]);
        toast('स्थिति सफलतापूर्वक परिवर्तन गरियो', 'success');
        return back();
    }

    public function formDetail(MapApply $mapApply, Form $form)
    {
        $form->load('formDataTypes.model', 'formDataTypes.appliedDocuments.appliedDocumentStatuses', 'formDataTypes.formStores.formStoreStatuses', 'formDataTypes.paymentStores.paymentStoreStatuses');
        return view('emap::admin.step.formFileUpload', compact('mapApply', 'form'));
    }


    public function storeDocument(Request $request, MapApply $mapApply, Form $form, FormDataType $formDataType)
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
                    'uploaded_by_type' => User::class,
                    'uploaded_by_id' => auth()->user()->id,
                    'form_data_type' => FormDataType::class,
                    'form_data_id' => $formDataType->id
                ]);
                foreach ($data['documents'] as $file) {
                    $appliedDocument->appliedMapFiles()->create([
                        "map_apply_id" => $mapApply->id,
                        "document" => $file->store('appliedDocument', 'public'),
                    ]);
                }
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
                    'uploaded_by_type' => User::class,
                    'uploaded_by_id' => auth()->user()->id,
                    'form_data_type' => FormDataType::class,
                    'form_data_id' => $formDataType->id,
                    'data' => $data['data'],
                    'fields' => $form->fields ?? ''
                ]);

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
            });
            toast('फारम सफलतापूर्वक थपियो', 'success');
        }
        return redirect(route('organization.admin.formDetail', [$mapApply, $form]));
    }

    public function updateDocument(Request $request, MapApply $mapApply, Form $form, FormDataType $formDataType, $id)
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
            });
            toast('फारम सफलतापूर्वक थपियो', 'success');
        }
        return redirect(route('emap.admin.mapApply.admin-step.formDetail', [$mapApply, $form]));
    }

}
