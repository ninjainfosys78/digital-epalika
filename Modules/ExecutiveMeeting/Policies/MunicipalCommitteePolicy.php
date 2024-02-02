<?php

namespace Modules\ExecutiveMeeting\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Modules\ExecutiveMeeting\Entities\MunicipalCommittee;

class MunicipalCommitteePolicy
{
    use HandlesAuthorization;

    public function create(User $user, MunicipalCommittee $municipalCommittee): Response
    {
        return $user->id === $municipalCommittee->user_id ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function view(User $user, MunicipalCommittee $municipalCommittee): Response
    {
        if (auth()->user()->role->type !== 'Super') {
            return $user->id === $municipalCommittee->user_id ? Response::allow()
                : Response::denyAsNotFound();
        }
        return Response::allow();
    }

    public function update(User $user, MunicipalCommittee $municipalCommittee): Response
    {
        if (auth()->user()->role->type !== 'Super') {
            return $user->id === $municipalCommittee->user_id ? Response::allow()
                : Response::denyAsNotFound();
        }
        return Response::allow();
    }

    public function delete(User $user, MunicipalCommittee $municipalCommittee): Response
    {
        if (auth()->user()->role->type !== 'Super') {
            return $user->id === $municipalCommittee->user_id ? Response::allow()
                : Response::denyAsNotFound();
        }
        return Response::allow();
    }
}
