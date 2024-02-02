<?php

namespace App\Http\Controllers\Admin\Global\Units;

use App\Http\Controllers\Controller;
use App\Models\Settings\Units\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('unitType_access');
        $types = Type::get();
        return view('admin.global.units.type.index', compact('types'));
    }

    public function create()
    {
        $this->checkAuthorization('unitType_create');

        return view('admin.global.units.type.create');
    }

    public function store(Request $request)
    {
        $this->checkAuthorization('unitType_create');
        $validationData = $request->validate(
            ['title' => 'required', Rule::unique('types', 'title')->withoutTrashed()],
            ['title.required' => 'मापन एकाइ प्रकार अनिवार्य छ|', 'title.unique' => 'मापन एकाइ प्रकार पहिले नै अवस्थित छ']
        );

        Type::create($validationData);
        toast('मापन एकाइ प्रकार सफलतापूर्वक थपियो', 'success');

        return redirect(route('admin.global.units.type.index'));
    }

    public function show(Type $type)
    {
        //
    }

    public function edit(Type $type)
    {
        $this->checkAuthorization('unitType_edit');

        return view('admin.global.units.type.edit', compact('type'));
    }

    public function update(Request $request, Type $type)
    {
        $this->checkAuthorization('unitType_edit');
        $validationData = $request->validate(
            ['title' => 'required', Rule::unique('types', 'title')->withoutTrashed()->ignore($type)],
            ['title.required' => 'मापन एकाइ प्रकार अनिवार्य छ|', 'title.unique' => 'मापन एकाइ प्रकार पहिले नै अवस्थित छ']
        );
        $type->update($validationData);

        toast('मापन एकाइ प्रकार सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.global.units.type.index'));
    }

    public function destroy(Type $type)
    {
        $this->checkAuthorization('unitType_delete');
        $type->delete();
        toast('मापन एकाइ प्रकार सफलतापूर्वक मेटाइयो', 'success');

        return back();
    }
}
