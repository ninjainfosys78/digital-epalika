<?php

namespace Modules\Identity\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Modules\Identity\Entities\SeniorCitizenDetail;

class SeniorCitizenDetailPolicy
{
    use HandlesAuthorization;

    public function create(User $user, SeniorCitizenDetail $seniorCitizenDetail): Response
    {
        return $user->id === $seniorCitizenDetail->user_id ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function view(User $user, SeniorCitizenDetail $seniorCitizenDetail): Response
    {
        if (auth()->user()->role->type !== 'Super') {
            return $user->id === $seniorCitizenDetail->user_id ? Response::allow()
                : Response::denyAsNotFound();
        }
        return Response::allow();
    }

    public function update(User $user, SeniorCitizenDetail $seniorCitizenDetail): Response
    {
        if (auth()->user()->role->type !== 'Super') {
            return $user->id === $seniorCitizenDetail->user_id ? Response::allow()
                : Response::denyAsNotFound();
        }
        return Response::allow();
    }

    public function delete(User $user, SeniorCitizenDetail $seniorCitizenDetail): Response
    {
        if (auth()->user()->role->type !== 'Super') {
            return $user->id === $seniorCitizenDetail->user_id ? Response::allow()
                : Response::denyAsNotFound();
        }
        return Response::allow();
    }
}
