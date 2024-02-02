<?php

namespace Modules\Recommendation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ShowApplicationListController extends Controller
{
    public function __invoke()
    {
        //        abort_if(
        //            Gate::denies('applicationFormSetting_access'),
        //            ResponseAlias::HTTP_FORBIDDEN,
        //            '403 Forbidden | you are not allowed to access this resource'
        //        );

        return view('recommendation::admin.application_list');
    }
}
