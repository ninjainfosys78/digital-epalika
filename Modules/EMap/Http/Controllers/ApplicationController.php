<?php

namespace Modules\EMap\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\MapApplicationNotification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Modules\EMap\Entities\Client;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Enums\FileTypeEnum;
use Modules\EMap\Enums\PostsEnum;

class ApplicationController extends Controller
{
    public function mapAcceptance(Client $client, MapApply $mapApply): Factory|View|Application
    {
        $mapApply->load('houseOwner', 'landDetail', 'landDetail.unit');

        return view('emap::organization.clients.map.application.map_acceptance', compact('client', 'mapApply'));
    }

    public function technicianApproval(Client $client, MapApply $mapApply): Factory|View|Application
    {
        $mapApply->load(['houseOwner', 'landDetail', 'landDetail.unit', 'designerDetails' => function ($query) {
            $query->where('post', PostsEnum::DESIGNER->value)->first();
        }]);

        return view('emap::organization.clients.map.application.technician_approval', compact('client', 'mapApply'));
    }

    public function engineerApproval(Client $client, MapApply $mapApply): Factory|View|Application
    {
        $mapApply->load(['houseOwner', 'landDetail', 'landDetail.unit', 'designerDetails' => function ($query) {
            $query->where('post', PostsEnum::DESIGNER->value)->first();
        }]);

        return view('emap::organization.clients.map.application.engineer_approval', compact('client', 'mapApply'));
    }

    public function superStructureConstructionPermission(Client $client, MapApply $mapApply): Factory|View|Application
    {
        $mapApply->load('landDetail', 'landDetail.unit', 'applicantDetail');

        return view('emap::organization.clients.map.application.super_structure_construction', compact('client', 'mapApply'));
    }

    public function constructionCompletionCertificate(Client $client, MapApply $mapApply)
    {
        $mapApply->load('applicantDetail', 'landDetail.unit');

        return view('emap::organization.clients.map.application.construction_completion_certificate', compact('client', 'mapApply'));
    }

    public function applyMapApplication(Request $request, Client $client, MapApply $mapApply)
    {
        $data = $request->validate([
            'file' => ['required', 'mimes:pdf'],
            'file_type' => ['required'],
        ]);

        $mapApplyData = $mapApply->applyMapNotices()->create($data + [
            'type' => FileTypeEnum::APPLICATION->value,
        ]);

        Notification::send(User::all(), new MapApplicationNotification($mapApplyData));
        toast('फाईल सफलता पुर्बक थपियो', 'success');

        return back();
    }
}
