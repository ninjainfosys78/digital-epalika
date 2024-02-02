<?php

namespace Modules\Grant\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Modules\Grant\Entities\GrantType;
use Modules\Grant\Http\Requests\Setting\GrantType\StoreGrantTypeRequest;
use Modules\Grant\Http\Requests\Setting\GrantType\UpdateGrantTypeRequest;

class GrantTypeController extends Controller
{
    public function index(): Factory|View|Application
    {
        $this->checkAuthorization('grantType_access');

        $grantTypes = GrantType::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['title'], request('search'));
            }
        })
            ->latest()->paginate(10);

        return view('grant::admin.setting.grantType.index', compact('grantTypes'));
    }

    public function create(): Factory|View|Application
    {
        $this->checkAuthorization('grantType_create');

        return view('grant::admin.setting.grantType.create');
    }

    public function store(StoreGrantTypeRequest $request)
    {
        $this->checkAuthorization('grantType_create');

        $grantType = GrantType::create($request->validated());

        if ($request->ajax()) {
            return response()->json([
                'data' => [
                    'id' => $grantType->id,
                    'title' => $grantType->title
                ],
                'message' => 'अनुदान प्रकार सफलता पुर्वक थपियो'
            ]);
        }

        toast('अनुदान प्रकार सफलता पुर्वक थपियो', 'success');
        return back();
    }

    public function edit(GrantType $grantType)
    {
        $this->checkAuthorization('grantType_edit');

        return view('grant::admin.setting.grantType.edit', compact('grantType'));
    }

    public function update(UpdateGrantTypeRequest $request, GrantType $grantType)
    {
        $this->checkAuthorization('grantType_edit');

        $grantType->update($request->validated());
        toast('अनुदान प्रकार सफलता पुर्वक सम्पादन गरियो', 'success');
        return redirect(route('admin.grant.setting.grantType.index'));
    }

    public function destroy(GrantType $grantType)
    {
        $this->checkAuthorization('grantType_delete');
        $grantType->delete();

        toast('अनुदान प्रकार सफलता पुर्वक हटाईयो', 'success');
        return back();
    }
}
