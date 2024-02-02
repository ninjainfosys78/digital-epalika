<?php

namespace Modules\Identity\Http\Controllers;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Identity\Entities\DisabilityCommittee;
use Modules\Identity\Entities\DisabilityIdentityCard;
use Modules\Identity\Entities\GovernmentalDisabilityType;
use Modules\Identity\Entities\IdentityMeeting;
use Modules\Identity\Entities\InvitedGuest;
use Modules\Identity\Http\Requests\IdentityMeeting\StoreIdentityMeetingRequest;
use Modules\Identity\Http\Requests\IdentityMeeting\UpdateIdentityMeetingRequest;
use View;

class IdentityMeetingController extends Controller
{
    public function index()
    {
        $disabilityIdentityCards = DisabilityIdentityCard::where('status', StatusEnum::ELIGIBILITY_FOR_MEETING->value)->get();
        $identityMeetings = IdentityMeeting::withCount('disabilityCommittees', 'invitedGuests', 'disabilityIdentityCards')
            ->latest('date_ad')
            ->get();

        return view('identity::admin.identityMeeting.index', compact('identityMeetings', 'disabilityIdentityCards'));
    }

    public function create()
    {
        $disabilityCommittees = DisabilityCommittee::orderBy('position')->get();
        $governmentDisabilityTypes = GovernmentalDisabilityType::orderBy('position')->get();
        $disabilityIdentityCards = DisabilityIdentityCard::where('status', StatusEnum::ELIGIBILITY_FOR_MEETING->value)->get();

        return view('identity::admin.identityMeeting.create', compact('disabilityCommittees', 'governmentDisabilityTypes', 'disabilityIdentityCards'));
    }

    public function store(StoreIdentityMeetingRequest $request)
    {
        DB::transaction(function () use ($request) {
            $identityMeeting = IdentityMeeting::create($request->validated());

            $identityMeeting->disabilityCommittees()->attach($request->validated()['committees']);
            $disabilityIds = $this->UpdateDisabilityIdentityCards($request);

            $identityMeeting->disabilityIdentityCards()->attach($disabilityIds);
            if (array_key_exists('guests', $request->validated()) && !empty($request->validated()["guests"])) {

                foreach ($request->validated()["guests"] as $guest) {
                    $identityMeeting->invitedGuests()->create($guest);
                }
            }
        });

        toast('बैठक सफलतापुर्बक थपियो', 'success');

        return redirect(route('identity.admin.identityMeeting.index'));
    }


    public function edit(IdentityMeeting $identityMeeting)
    {
        $disabilityCommittees = DisabilityCommittee::orderBy('position')->get();
        $governmentDisabilityTypes = GovernmentalDisabilityType::orderBy('position')->get();

        $identityMeeting->load('disabilityCommittees', 'invitedGuests', 'disabilityIdentityCards');
        return view('identity::admin.identityMeeting.edit', compact('identityMeeting', 'disabilityCommittees', 'governmentDisabilityTypes'));
    }

    public function update(UpdateIdentityMeetingRequest $request, IdentityMeeting $identityMeeting)
    {
        DB::transaction(function () use ($request, $identityMeeting) {
            $identityMeeting->update($request->validated());

            $identityMeeting->disabilityCommittees()->sync($request->validated()['committees']);
            if (array_key_exists('disabilityIdentityCards', $request->validated()) && !empty($request->validated()['disabilityIdentityCards'])) {
                $existingId = $identityMeeting->disabilityIdentityCards->pluck('id')->toArray();

                $disabilityIds = $this->UpdateDisabilityIdentityCards($request);
                $remainingId = array_diff($existingId, $disabilityIds);

                DisabilityIdentityCard::whereIn('id', $remainingId)
                    ->update([
                        'gov_disability_type_id' => null,
                        'status' => ($request->boolean('is_full_detail_required')
                            || !recommendationTemplateSettingData()?->is_hospital_detail_required)
                            ? StatusEnum::ELIGIBILITY_FOR_MEETING->value
                            : StatusEnum::PENDING->value,
                    ]);

                $identityMeeting->disabilityIdentityCards()->sync($disabilityIds);
            }
            if (array_key_exists('guests', $request->validated()) && !empty($request->validated()["guests"])) {
                foreach ($request->validated()["guests"] as $guest) {
                    if (array_key_exists('id', $guest) && !empty($guest['id'])) {
                        InvitedGuest::find($guest['id'])->update($guest);
                    } else {
                        $identityMeeting->invitedGuests()->create($guest);
                    }
                }
            }
        });

        toast('बैठक सफलतापुर्बक थपियो', 'success');

        return redirect(route('identity.admin.identityMeeting.index'));
    }

    public function destroy(IdentityMeeting $identityMeeting)
    {

        $identityMeeting->delete();
        toast('बैठक सफलतापूर्वक हटाइयो', 'success');

        return redirect(route('identity.admin.identityMeeting.index'));
    }

    public function minuteIndex(IdentityMeeting $identityMeeting)
    {
        return view('identity::admin.identityMeeting.minute', compact('identityMeeting'));

    }

    public function minutePrint(IdentityMeeting $identityMeeting)
    {
        return response()->json([
            'view' => (string)View::make('identity::admin.identityMeeting.minutePrint', compact('identityMeeting')),
        ]);
    }

    public function minuteStore(Request $request, IdentityMeeting $identityMeeting)
    {
        $request->validate([
            'minute' => ['required', 'string']
        ]);

        $identityMeeting->update([
            'minute' => $request->input('minute')
        ]);

        toast('बैठकको माईनिउट सफलतापूर्वक राखियो', 'success');

        return redirect(route('identity.admin.identityMeeting.index'));

    }

    private function UpdateDisabilityIdentityCards($request): array
    {
        $disabilityIds = [];

        foreach ($request->validated()['disabilityIdentityCards'] as $disabilityIdentityCard) {
            if (!empty($disabilityIdentityCard['id'])) {
                $disabilityIdentityCardDetail = DisabilityIdentityCard::find($disabilityIdentityCard['id']);
                $disabilityIdentityCardDetail->update([
                    'gov_disability_type_id' => $disabilityIdentityCard['gov_disability_type_id'],
                    'status' => $disabilityIdentityCardDetail?->is_full_detail_required ? StatusEnum::READY_FOR_PRINT->value : StatusEnum::APPROVE->value
                ]);
                $disabilityIds[] = $disabilityIdentityCard['id'];
            }
        }
        return $disabilityIds;
    }
}
