<?php

namespace Modules\DigitalBoard\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Settings\Branch;
use Modules\DigitalBoard\Entities\Service;

class FrontController extends Controller
{
    public function showServiceDetail(Service $service)
    {
        return view('digitalboard::frontend.services.details', compact('service'));
    }

    public function helpDesk()
    {
        $branches = Branch::with('branches')->whereNull('branch_id')->get();

        return view('digitalboard::frontend.index', compact('branches'));
    }

    public function service()
    {
        return view('digitalboard::frontend.services.service');
    }

    public function getServices($id = null)
    {
        if ($id) {
            $services = Service::where('branch_id', $id)->get();
        } else {
            $services = Service::whereNull('branch_id')->get();
        }
        return $services;
    }
}
