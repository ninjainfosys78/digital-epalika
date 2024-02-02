<?php

namespace Modules\EMap\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\EMap\Entities\DynamicForm;
use Modules\EMap\Entities\EMapTemplate;
use Modules\EMap\Entities\Form;
use Modules\EMap\Entities\FormDataType;
use Modules\EMap\Entities\MapPassGroup;
use Modules\EMap\Enums\FormTypeEnum;

class FormDataTypeLivewire extends Component
{
    public $formData;
    public array $form = [
        'title' => null,
        'order' => null,
        'map_pass_group_id' => null,
        'map_group_id'=>null,
        'need_from' => null,
        'formDataType' => [],
        'show_to_consultancy'=>null

    ];
    public $mapPassGroups = [];
    public $existingForm = null;

    public function mount($formData = null)
    {
        $this->mapPassGroups = MapPassGroup::all();

        if (!empty($formData)) {
            $this->existingForm = $formData;
            $this->form['title'] = $formData->title;
            $this->form['order'] = $formData->order;
            $this->form['map_pass_group_id'] = $formData->map_pass_group_id;
            $this->form['map_group_id'] = $formData->map_group_id;
            $this->form['need_from'] = $formData->need_from->value;
            $this->form['show_to_consultancy'] = $formData->show_to_consultancy;

            foreach ($formData->formDataTypes as $index => $formDataType) {
                $this->form['formDataType'][]=[
                    'id'=>$formDataType->id ?? null,
                    'type'=>$formDataType->type ?? null,
                    'model_id'=>$formDataType->model_id ?? null,
                    'data'=>$this->resolveData($formDataType->type->value) ?? null,

                ] ;
            }
        }else{
            $this->form['formDataType'][] = [[]];
        }
    }

    public function addData(): void
    {
        $this->form['formDataType'][] =   [];
    }

    public function removeData($index): void
    {
        if (isset($this->form['formDataType'][$index])) {
            $formDataType = $this->form['formDataType'][$index];

            if (isset($formDataType['id'])) {
                $formDataTypeRecord = FormDataType::find($formDataType['id']);
                if ($formDataTypeRecord) {
                    $formDataTypeRecord->delete();
                }
            }
            $formDataTypeCollection = collect($this->form['formDataType']);
            $formDataTypeCollection->forget($index);

            $this->form['formDataType'] = $formDataTypeCollection->values()->all();
        }
    }

    public function changeData($index): void
    {
        $this->form['formDataType'][$index]['data'] = $this->resolveData($this->form['formDataType'][$index]['type']);
        $this->form['formDataType'][$index]['data'] = $this->resolveData($this->form['formDataType'][$index]['type']);
        $this->form['formDataType'][$index]['model_id'] = null;
    }

    public function resolveData($type)
    {
        return match ($type) {
            FormTypeEnum::FILE->value => EMapTemplate::where('status', 1)->pluck('title', 'id'),
            FormTypeEnum::FORM->value => DynamicForm::where('status', 1)->pluck('title', 'id'),
            default => null
        };
    }

    protected $rules = [
        "form.title" => ['required'],
        "form.order" => ['nullable'],
        "form.map_pass_group_id" => ['required', 'integer', 'exists:map_pass_groups,id,deleted_at,NULL'],
        "form.map_group_id" => ['required', 'integer', 'exists:map_pass_groups,id,deleted_at,NULL'],
        "form.need_from" => ['required'],
        'form.show_to_consultancy' => ['required_if:form.need_from,==,office'],
        "form.formDataType" => ['required', 'array'],
        "form.formDataType.*.type" => ['required'],
        "form.formDataType.*.model_id" => ['nullable', 'int'],
    ];


    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validatedData = $this->validate();
        DB::transaction(function () use ($validatedData) {
            if (!empty($this->existingForm)) {
                $this->existingForm->update($validatedData['form']);
                $form = $this->existingForm;
                foreach ($this->form['formDataType'] as $formDataType) {
                    if (array_key_exists('id', $formDataType)) {
                        $formDataTypeData = FormDataType::find($formDataType['id']);
                        $formDataTypeData->update($formDataType);
                    } else {
                        $formDataTypeData = $form->formDataTypes()->create($formDataType);
                    }
                }
            } else {
                $form = Form::create($validatedData['form']);
                foreach ($this->form['formDataType'] as $formDataType) {
                    $formDataTypeData = $form->formDataTypes()->create($formDataType);
                }
            }
        });
        $this->reset('form');
        toast('सफलतापूर्वक थपियो', 'success');
        return redirect()->route('emap.admin.form.index');
    }

    public function render()
    {
        if ($this->form['need_from'] != \Modules\EMap\Enums\EMapFormFillerTypeEnum::OFFICE->value) {
            $this->form['show_to_consultancy'] = 1;
        }
        return view('emap::livewire.form-data-type-livewire');
    }
}
