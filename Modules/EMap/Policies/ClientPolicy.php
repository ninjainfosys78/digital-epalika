<?php

namespace Modules\EMap\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Modules\EMap\Entities\Client;
use Modules\EMap\Entities\Organization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function view(Organization $organization, Client $client): Response
    {
        return $organization->id === $client->organization_id ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function update(Organization $organization, Client $client): Response
    {
        return $organization->id === $client->organization_id ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function delete(Organization $organization, Client $client): Response
    {
        return $organization->id === $client->organization_id ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function restore(Organization $organization, Client $client): Response
    {
        return $organization->id === $client->organization_id ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function forceDelete(Organization $organization, Client $client): Response
    {
        return $organization->id === $client->organization_id ? Response::allow()
            : Response::denyAsNotFound();
    }
}
