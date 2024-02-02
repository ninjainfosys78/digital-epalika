<?php

namespace Modules\GrievanceHandling\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\GrievanceDetailMail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Modules\GrievanceHandling\Entities\GrievanceDetail;
use Modules\GrievanceHandling\Entities\GrievanceType;
use Modules\GrievanceHandling\Enums\GrievanceStatus;

class FrontendController extends Controller
{
    public function grievanceHandling(): Factory|View|Application
    {
        $grievanceTypes = GrievanceType::withCount('grievanceDetails')->latest()->get();
        $grievanceDetails = GrievanceDetail::whereNull('grievance_detail_id')->public()->get();

        $grievanceCount = GrievanceDetail::whereNull('grievance_detail_id')->count();
        $registeredGrievanceCount = GrievanceDetail::whereNull('grievance_detail_id')->approved()->count();
        $closedGrievanceCount = GrievanceDetail::whereNull('grievance_detail_id')->where('status', GrievanceStatus::CLOSED->value)->count();
        $investigatedGrievanceCount = GrievanceDetail::whereNull('grievance_detail_id')->where('status', GrievanceStatus::INVESTIGATED->value)->count();
        $seenGrievanceCount = GrievanceDetail::whereNull('grievance_detail_id')->where('status', '!=', GrievanceStatus::UNSEEN->value)->count();
        $unseenGrievanceCount = GrievanceDetail::whereNull('grievance_detail_id')->where('status', GrievanceStatus::UNSEEN->value)->count();

        return view(
            'grievancehandling::frontend.index',
            compact(
                'grievanceTypes',
                'grievanceDetails',
                'grievanceCount',
                'registeredGrievanceCount',
                'closedGrievanceCount',
                'investigatedGrievanceCount',
                'seenGrievanceCount',
                'unseenGrievanceCount'
            )
        );
    }

    public function singleGrievance(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'phone' => ['required'],
        ]);

        $grievanceDetail = GrievanceDetail::with('grievanceDetails.files', 'grievanceDetails.user', 'grievanceDetails.grievanceUser', 'files', 'grievanceType', 'branch')
            ->whereNull('grievance_detail_id')
            ->whereHas('grievanceUser', function ($query) use ($request) {
                $query->where('phone', $request->input('phone'));
            })
            ->where('token', $request->input('token'))
            ->first();

        if ($grievanceDetail) {
            return view('grievancehandling::frontend.grievance.single-grievance', compact('grievanceDetail'));
        }
        toast('तपाइले उपलब्ध गराएको विवरण मिलेन', 'error');
        return back();
    }

    public function policy()
    {
        return view('grievancehandling::frontend.policy.policy');
    }

    public function register()
    {
        return view('grievancehandling::frontend.register.register-form');
    }

    public function track()
    {
        return view('grievancehandling::frontend.track.track');
    }

    public function replyGrievance(Request $request, GrievanceDetail $grievanceDetail)
    {
        $validated = $request->validate([
            'description' => ['required'],
            'files' => ['array', 'nullable'],
            'files.*' => ['mimes:png,jpeg,jpg'],
        ]);

        DB::transaction(function () use ($request, $validated, $grievanceDetail) {
            $data = $grievanceDetail->grievanceDetails()->create($validated + [
                'grievance_user_id' => $grievanceDetail->grievance_user_id,
            ]);

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $data->files()->create([
                        'file_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                        'extension' => $file->getClientOriginalExtension(),
                        'file' => $file->store('grievanceDocument/documents', 'public'),
                    ]);
                }
            }
            //mail to assigned user
            Mail::to($grievanceDetail->assignedUser->email)->send(new GrievanceDetailMail(
                $data->grievanceUser->name . " has replied $data->description to $grievanceDetail->token grievance."
            ));
        });

        toast('गुनासो सफलतापुर्बक पेश गरियो', 'success');

        return back();
    }

    public function publicGrievance()
    {
        return view('grievancehandling::frontend.grievance.public-grievance');
    }

    public function grievanceList()
    {
        return view('grievancehandling::frontend.grievance.grievance-list');
    }
}
