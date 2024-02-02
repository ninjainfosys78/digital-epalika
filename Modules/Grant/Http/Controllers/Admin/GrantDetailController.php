<?php

namespace Modules\Grant\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Modules\Grant\Entities\Grant;
use Modules\Grant\Entities\GrantDetail;
use Modules\Grant\Entities\GrantType;

class GrantDetailController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('grantDetail_access');

        $grants = Grant::with('grant_program_name');

        $grantDetails = GrantDetail::with('grant.fiscalYear', 'grant.grantType', 'model', 'localBody')
            ->where(function (Builder $q) {
                if (!is_null(request('search'))) {
                    $q->whereLike('contact', request('search'));
                    $q->orWhereHas('grant_program_name', function ($sub_q) {
                        $sub_q->whereLike('name', request('search'));
                    });
                }


                if (!auth()->user()?->load('role')?->role?->type == 'Super') {
                    $q->where('user_id', auth()->id());
                }
            })
            ->latest()
            ->paginate(10);

        return view('grant::admin.grant_detail.index', compact('grantDetails', 'grants'));
    }

    public function checkGrant()
    {
        $this->checkAuthorization('grantDetail_create');
        return view('grant::admin.grant_detail.check');

    }

    public function create()
    {
        $this->checkAuthorization('grantDetail_create');

        return view('grant::admin.grant_detail.create');
    }

    public function show(GrantDetail $grantDetail)
    {
        $this->checkAuthorization('grantDetail_access');

        return view('grant::admin.grant_detail.show', compact('grantDetail'));
    }

    public function edit(GrantDetail $grantDetail)
    {
        $this->checkAuthorization('grantDetail_edit');

        $grantTypes = GrantType::all();
        return view('grant::admin.grant_detail.edit', compact('grantDetail', 'grantTypes'));
    }

    public function destroy(GrantDetail $grantDetail)
    {
        $this->checkAuthorization('grantDetail_delete');

        $grantDetail->delete();

        toast('अनुदान विवरण सफलतापूर्वक मेटाइयो', 'success');
        return back();
    }
}
