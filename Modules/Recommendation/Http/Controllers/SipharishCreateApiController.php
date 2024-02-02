<?php

namespace Modules\Recommendation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Recommendation\Entities\SipharisCategory;
use Modules\Recommendation\Entities\SipharishCreate;
use Modules\Recommendation\Entities\SipharishFormType;
use Modules\Recommendation\Entities\SipharisSubCategory;
use Modules\Recommendation\Http\Requests\SipharishCreated\StoreSipharisCreatedRequest;
use Modules\Recommendation\Transformers\SipharishCreateListResource;
use Modules\Recommendation\Transformers\SipharishCreateResource;
use Modules\Recommendation\Transformers\SipharishFormFieldResource;
use Modules\Recommendation\Transformers\SipharishFormTypeResource;

class SipharishCreateApiController extends Controller
{
    public function index()
    {
        $sifarishCategories = SipharisCategory::with('createdBy')->where('status', 1)->get();
        return response()->json(SipharishCreateResource::collection($sifarishCategories));
    }

    public function show(SipharisCategory $sipharisCategory)
    {

        $sifarishSubCategories = SipharisSubCategory::where('sipharis_category_id', $sipharisCategory->id)
            ->where('status', 1)
            ->get();
        return response()->json(SipharishCreateResource::collection($sifarishSubCategories));
    }

    public function subCategoryList()
    {
        $sifarishCategories = SipharisSubCategory::with('createdBy')->where('status', 1)->get();
        return response()->json(SipharishCreateResource::collection($sifarishCategories));
    }

    public function subCategoryShow(SipharisSubCategory $sipharisSubCategory)
    {
        $sipharisFormTypes = SipharishFormType::with('createdBy')->where('status', 1)
            ->where('sipharis_sub_category_id', $sipharisSubCategory->id)
            ->get();
        return response()->json(SipharishFormTypeResource::collection($sipharisFormTypes));
    }

    public function sipharishFormTypeList(SipharishFormType $sipharishFormType)
    {
        $fields = SipharishFormType::with('sipharisFormFields.SipharishFormFields.createdBy', 'sipharisFormFields.createdBy')
            ->find($sipharishFormType->id)
            ?->sipharisFormFields;
        return response()->json(SipharishFormFieldResource::collection($fields));
    }

    public function store(StoreSipharisCreatedRequest $request)
    {
        DB::transaction(function () use ($request) {
            $sipharis = auth()->user()?->sipharishCreates()?->create($request->validated());
            if (
                array_key_exists('fields', $request->validated())
                && !empty($request->validated()['fields'])
            ) {
                foreach ($request->validated()['fields'] as $field) {

                    if (!empty($field['type']) && $field['type'] == 'image') {
                        $value = $this->storeFile($field['value']);
                    } elseif (!empty($field['type']) && $field['type'] == 'table') {
                        $values = collect();
                        if (!empty($field['table'])) {
                            foreach ($field['table'] as $table) {
                                $row = collect();
                                foreach ($table as $key => $tbl) {
                                    if (!empty($tbl['type']) && $tbl['type'] == 'image') {
                                        $tableValue = $this->storeFile($tbl['value']);
                                    } else {
                                        $tableValue = $tbl['value'];
                                    }
                                    $row->put($key, [
                                        'value' => $tableValue,
                                        'type' => $tbl['type'],
                                    ]);
                                }
                                $values->push($row);
                            }
                        }
                        $value = json_encode($values);
                    } else {
                        $value = $field['value'];
                    }

                    $sipharis->SipharishCreatedValues()
                        ->create([
                            'sipharish_form_field_id' => $field['sipharish_form_field_id'] ?? '',
                            'value' => $value ?? '',
                            'type' => $field['type'] ?? '',
                        ]);
                }
            }

            if (
                array_key_exists('files', $request->validated())
                && !empty($request->validated()['files'])
            ) {

                foreach ($request->validated()['files'] as $file) {
                    $sipharis->SipharisCreatedDocuments()->create($file + [
                            'extension' => $file['filename']->getClientOriginalExtension()
                        ]);
                }
            }

            return $sipharis;
        });

        return response()->json([
            'message' => 'Sipharish Create Stored Successfully'
        ]);
    }

    public function sipharishCreateList()
    {
        $sipharishCreates = SipharishCreate::with('SipharishFormType')
            ->where('mobile_user_id', auth()->user()->id)
            ->latest()->get();

        return response()->json(SipharishCreateListResource::collection($sipharishCreates));
    }

    public function sipharishCreateShow(SipharishCreate $sipharishCreate)
    {
        $sipharishCreate->load('SipharishCreatedValues.SipharisFormField', 'SipharisCreatedDocuments');

        return response()->json(SipharishCreateListResource::make($sipharishCreate));
    }


    public function storeFile($value): ?string
    {
        if (!empty($value)) {
            if (empty($value['data'])) {
                return '';
            }
            $decodedData = base64_decode($value['data']);
            $date = now()->format('Y_m_d');
            $name = $value['name'] . "." . $value['extension'];
            $path = "recommendation/{$date}/{$name}";
            Storage::disk('public')->put($path, $decodedData);
            if (Storage::disk('public')->exists($path)) {
                return $path;
            } else {
                return '';
            }
        }
        return '';
    }
}
