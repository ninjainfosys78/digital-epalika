<?php

namespace Modules\Grant\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Modules\Grant\Entities\GrantProgram;
use Modules\Grant\Http\Requests\Setting\GrantProgram\StoreGrantProgramRequest;
use Modules\Grant\Http\Requests\Setting\GrantProgram\UpdateGrantProgramRequest;

class GrantProgramController extends Controller
{
    public function index(): Factory|View|Application
    {
        $this->checkAuthorization('grantProgram_access');
        $grantPrograms = GrantProgram::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['name'], request('search'));
            }
        })
            ->latest()->paginate(10);
        return view('grant::admin.setting.grantProgram.index', compact('grantPrograms'));
    }

    public function create(): Factory|View|Application
    {
        $this->checkAuthorization('grantProgram_create');

        return view('grant::admin.setting.grantProgram.create');
    }

    public function store(StoreGrantProgramRequest $request)
    {
        $this->checkAuthorization('grantProgram_create');

        $grantProgram = GrantProgram::create($request->validated());

        if ($request->ajax()) {
            return response()->json([
                'data' => [
                    'grantProgram_id' => $grantProgram->id,
                    'grantProgram_name' => $grantProgram->name
                ],
                'message' => 'अनुदान कार्यक्रम सफलता पुर्वक थपियो'
            ]);
        }

        toast('अनुदान कार्यक्रम सफलता पुर्वक थपियो', 'success');
        return back();
    }


    public function edit(GrantProgram $grantProgram)
    {
        $this->checkAuthorization('grantProgram_edit');

        return view('grant::admin.setting.grantProgram.edit', compact('grantProgram'));
    }

    public function update(UpdateGrantProgramRequest $request, GrantProgram $grantProgram)
    {
        $this->checkAuthorization('grantProgram_edit');

        $grantProgram->update($request->validated());
        toast('अनुदान कार्यक्रम सफलता पुर्वक सम्पादन गरियो', 'success');
        return redirect(route('admin.grant.setting.grantProgram.index'));
    }

    public function destroy(GrantProgram $grantProgram)
    {
        $this->checkAuthorization('grantProgram_delete');
        $grantProgram->delete();
        toast('अनुदान कार्यक्रम सफलता पुर्वक हटाइयो', 'success');
        return back();
    }
}
