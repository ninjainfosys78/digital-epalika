<?php

namespace Modules\Identity\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Modules\Identity\Entities\DisabilityIdentityCard;

class DisabilityIdentityCardPolicy
{
    use HandlesAuthorization;

    public function create(User $user, DisabilityIdentityCard $disabilityIdentityCard): Response
    {
        return $user->id === $disabilityIdentityCard->user_id ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function view(User $user, DisabilityIdentityCard $disabilityIdentityCard): Response
    {
        if (auth()->user()->role->type !== 'Super') {
            return $user->id === $disabilityIdentityCard->user_id ? Response::allow()
                : Response::denyAsNotFound();
        }
        return Response::allow();
    }

    public function update(User $user, DisabilityIdentityCard $disabilityIdentityCard): Response
    {
        if (auth()->user()->role->type !== 'Super') {
            return $user->id === $disabilityIdentityCard->user_id ? Response::allow()
                : Response::denyAsNotFound();
        }
        return Response::allow();
    }

    public function delete(User $user, DisabilityIdentityCard $disabilityIdentityCard): Response
    {
        if (auth()->user()->role->type !== 'Super') {
            return $user->id === $disabilityIdentityCard->user_id ? Response::allow()
                : Response::denyAsNotFound();
        }
        return Response::allow();
    }
}
