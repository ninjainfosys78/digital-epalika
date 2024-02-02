<?php

namespace Modules\EMap\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\EMap\Entities\DynamicForm;
use Modules\EMap\Http\Requests\DynamicForm\StoreDynamicFormRequest;
use Modules\EMap\Http\Requests\DynamicForm\UpdateDynamicFormRequest;

class DynamicFormController extends Controller
{
    public function index()
    {
        $dynamicForms = DynamicForm::latest()->get();
        return view('emap::admin.dynamicForm.index', compact('dynamicForms'));
    }

    public function create()
    {
        return view('emap::admin.dynamicForm.create');
    }

    public function store(StoreDynamicFormRequest $request)
    {
        DynamicForm::create($request->validated());

        toast('फारम थपियो', 'success');
        return back();
    }

    public function show(DynamicForm $dynamicForm)
    {
        return view('emap::admin.dynamicForm.show', compact('dynamicForm'));
    }

    public function edit(DynamicForm $dynamicForm)
    {
        return view('emap::admin.dynamicForm.edit', compact('dynamicForm'));
    }

    public function update(UpdateDynamicFormRequest $request, DynamicForm $dynamicForm)
    {
        $dynamicForm->update($request->validated());
        toast('फारम सम्पादन गरियो', 'success');
        return back();
    }

    public function destroy(DynamicForm $dynamicForm)
    {
        if ($dynamicForm->status) {
            toast('फारम सक्रिय छ', 'error');
            return back();
        }
        $dynamicForm->delete();
        toast('फारम हटाइयो', 'success');
        return back();
    }

    public function updateStatus(DynamicForm $dynamicForm)
    {
        $dynamicForm->update([
            'status' => !$dynamicForm->status
        ]);
        toast('फारम सम्पादन गरियो', 'success');
        return back();
    }

    public function template(DynamicForm $dynamicForm)
    {
        $data = collect(json_decode($dynamicForm->fields, true))
            ->map(function ($collection) {
                return collect($collection)->pluck('label', 'key');
            });

        return view('emap::admin.dynamicForm.template', compact('dynamicForm', 'data'));
    }

    public function templateStore(Request $request, DynamicForm $dynamicForm)
    {
        $data =  $request->validate([
            'template' => ['required']
         ]);

        $dynamicForm->update($data);
        toast('फारम सम्पादन गरियो', 'success');
        return back();
    }
}
