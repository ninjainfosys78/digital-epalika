<?php

namespace Modules\ExecutiveMeeting\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Modules\ExecutiveMeeting\Entities\WardCommittee;

class WardCommitteePolicy
{
    use HandlesAuthorization;

    public function create(User $user, WardCommittee $wardCommittee): Response
    {
        return $user->id === $wardCommittee->user_id ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function view(User $user, WardCommittee $wardCommittee): Response
    {
        if (auth()->user()->role->type !== 'Super') {
            return $user->id === $wardCommittee->user_id ? Response::allow()
                : Response::denyAsNotFound();
        }
        return Response::allow();
    }

    public function update(User $user, WardCommittee $wardCommittee): Response
    {
        if (auth()->user()->role->type !== 'Super') {
            return $user->id === $wardCommittee->user_id ? Response::allow()
                : Response::denyAsNotFound();
        }
        return Response::allow();
    }

    public function delete(User $user, WardCommittee $wardCommittee): Response
    {
        if (auth()->user()->role->type !== 'Super') {
            return $user->id === $wardCommittee->user_id ? Response::allow()
                : Response::denyAsNotFound();
        }
        return Response::allow();
    }
}
