<?php

namespace Modules\EMap\Http\Controllers;

use Illuminate\Http\Request;
use Modules\EMap\Entities\Form;
use App\Http\Controllers\Controller;
use Modules\EMap\Http\Requests\NaksaForm\StoreFormRequest;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::orderBy('order')->get();
        return view('emap::admin.form.index', compact('forms'));
    }

    public function create()
    {
        return view('emap::admin.form.create');
    }

    public function store(StoreFormRequest $request)
    {


    }

    public function show($id)
    {
        return view('emap::show');
    }

    public function edit(Form $form)
    {
        $form->load('formDataTypes');
        return view('emap::admin.form.edit', compact('form'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Form $form)
    {
        if ($form->status) {
            toast('सक्रिय भएको नक्शा पास समूह मेटाउन मनाहि छ', 'error');
            return back();
        }
        $form->delete();
        toast('नक्शा पास समूह मेटियो', 'success');
        return back();
    }

    public function updateStatus(Form $form)
    {
       

        $form->update([
            'status' => !$form->status
        ]);
        toast('नक्शा पास समूह सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }
}
