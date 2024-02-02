<?php

namespace Modules\GrievanceHandling\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\GrievanceDetailMail;
use App\Mail\GrievanceHandling\GrievanceAssignmentFromUserMail;
use App\Mail\GrievanceHandling\GrievanceAssignmentToGrievanceUserMail;
use App\Mail\GrievanceHandling\GrievanceAssignmentToUserMail;
use App\Mail\GrievanceHandling\GrievanceRegistrationAssignedUserMail;
use App\Mail\GrievanceHandling\GrievanceRegistrationUserMail;
use App\Models\Settings\Branch;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\GrievanceHandling\Entities\GrievanceDetail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Modules\GrievanceHandling\Entities\GrievanceType;
use Modules\GrievanceHandling\Entities\GrievanceUser;
use Modules\GrievanceHandling\Http\Requests\GrievanceDetail\StoreGrievanceDetailRequest;

class GrievanceDetailController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('grievanceDetail_access');

        $grievanceDetails = GrievanceDetail::with('grievanceType')->whereNull('grievance_detail_id')->where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['token', 'grievanceType.title',], request('search'));
            }
        })
            ->latest()->paginate(10);


        return view('grievancehandling::admin.grievanceDetail.index', compact('grievanceDetails'));
    }

    public function create()
    {
        $this->checkAuthorization('grievanceDetail_create');

        $grievanceDetail = GrievanceDetail::find(1);
        $grievanceTypes = GrievanceType::all();
        $isAnonymous = $grievanceDetail->is_anonymous;
        $branches = Branch::all();
        $grievanceUsers = GrievanceUser::latest()->get();
        $users = User::whereNot('id', auth()->id())->get();

        return view('grievancehandling::admin.grievanceDetail.create', compact('grievanceTypes', 'branches', 'grievanceUsers', 'users', 'isAnonymous'));
    }

    public function store(StoreGrievanceDetailRequest $request)
    {
        $this->checkAuthorization('grievanceDetail_create');

        DB::transaction(function () use ($request) {
            $grievanceDetail = GrievanceDetail::create(Arr::except($request->validated(), ['assigned_user_id']) + [
                'publisher_id' => auth()->id(),
                'assigned_user_id' => $request->input('assigned_user_id') ?? auth()->id(),
                'assigned_at' => now(),
                'token' => time(),
            ]);

            foreach ($request->file('files') ?? [] as $file) {
                $grievanceDetail->files()->create([
                    'file_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'extension' => $file->getClientOriginalExtension(),
                    'file' => $file->store('grievance/files', 'public'),
                ]);
            }

            $grievanceDetail->grievanceAssignHistories()->create([
                'from_user_id' => auth()->id(),
                'user_id' => $grievanceDetail->assigned_user_id
            ]);
            //mail to assigned user
            // Mail::to($grievanceDetail->assignedUser->email)
            // ->send(new GrievanceRegistrationAssignedUserMail($grievanceDetail));

            // //mail to grievance user
            // if ($grievanceDetail->grievanceUser->email) {
            //     Mail::to($grievanceDetail->assignedUser->email)
            //     ->send(new GrievanceRegistrationUserMail($grievanceDetail));
            // }
        });

        toast('गुनासो सफलतापुर्बक दर्ता भयो', 'success');

        return redirect(route('admin.grievanceHandling.grievanceDetail.index'));
    }

    public function show(GrievanceDetail $grievanceDetail)
    {
        $this->checkAuthorization('grievanceDetail_access');
        $grievanceDetail->load(
            'grievanceDetails.files',
            'grievanceDetails.user',
            'grievanceDetails.grievanceUser',
            'grievanceDetails.is_anonymous',
            'grievanceType',
            'branch',
            'publisher',
            'assignedUser',
            'files',
            'grievanceAssignHistories.grievanceDetail',
            'grievanceAssignHistories.fromUser',
            'grievanceAssignHistories.user'
        );

        if ($grievanceDetail->grievanceUser && isset($grievanceDetail->grievanceUser->is_anonymous)) {
            $is_anonymous = $grievanceDetail->grievanceUser->is_anonymous;
        }

        $users = User::all();

        return view('grievancehandling::admin.grievanceDetail.show', compact('grievanceDetail', 'users'));
    }


    public function edit($id)
    {
        $this->checkAuthorization('grievanceDetail_edit');

        return view('grievancehandling::edit');
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization('grievanceDetail_edit');
    }

    public function destroy($id)
    {
        $this->checkAuthorization('grievanceDetail_delete');
    }

    public function updateStatus(Request $request, GrievanceDetail $grievanceDetail): RedirectResponse
    {
        $grievanceDetail->update([
            'status' => $request->input('status'),
        ]);
        toast('स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }

    public function replayGrievance(Request $request, GrievanceDetail $grievanceDetail): RedirectResponse
    {
        $validated = $request->validate([
            'description' => ['required'],
            'files.*' => ['mimes:png,jpeg,jpg'],
            'files' => ['array', 'nullable'],
        ]);

        DB::transaction(function () use ($request, $validated, $grievanceDetail) {
            $data = $grievanceDetail->grievanceDetails()->create($validated + [
                'grievance_user_id' => $grievanceDetail->grievance_user_id,
                'user_id' => auth()->id(),
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

            //mail to grievance user
            if ($grievanceDetail->grievanceUser->email) {
                Mail::to($grievanceDetail->grievanceUser->email)->send(new GrievanceDetailMail(
                    $data->user->name . " has replied $data->description to your posted grievance."
                ));
            }
        });

        toast('गुनासो को प्रतिकृया सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function showToPublic(GrievanceDetail $grievanceDetail): RedirectResponse
    {
        $grievanceDetail->update(['is_public' => !$grievanceDetail->is_public]);
        toast('सफलतापूर्वक सार्वजनिक गरियो', 'success');

        return back();
    }

    public function approve(GrievanceDetail $grievanceDetail): RedirectResponse
    {
        $grievanceDetail->update(['is_approved' => !$grievanceDetail->is_approved]);
        toast('सफलतापूर्वक दर्ता गरियो', 'success');

        return back();
    }

    public function grievanceTransfer(Request $request, GrievanceDetail $grievanceDetail)
    {
        $request->validate([
            'transfer_user_id' => ['required', Rule::exists('users', 'id')->withoutTrashed()]
        ]);

        DB::transaction(function () use ($grievanceDetail, $request) {
            $grievanceAssign = $grievanceDetail->grievanceAssignHistories()->create([
                'from_user_id' => $grievanceDetail->assigned_user_id,
                'user_id' => $request->input('transfer_user_id')
            ]);
            $grievanceDetail->update([
                'assigned_user_id' => $request->input('transfer_user_id'),
                'assigned_at' => now()
            ]);

            //mail to assigned user
            Mail::to($grievanceAssign->user->email)->send(new GrievanceAssignmentToUserMail($grievanceDetail, $grievanceAssign));

            //mail to (from assigned user)
            Mail::to($grievanceAssign->fromUser->email)->send(new GrievanceAssignmentFromUserMail($grievanceDetail, $grievanceAssign));

            //mail to grievance user
            if ($grievanceDetail->grievanceUser->email) {
                Mail::to($grievanceDetail->grievanceUser->email)->send(new GrievanceAssignmentToGrievanceUserMail($grievanceDetail, $grievanceAssign));
            }
        });

        toast('Grievance Transferred Successfully', 'success');
        return back();
    }
}
