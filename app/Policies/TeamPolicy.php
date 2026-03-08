<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\FrontPage\Team;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class TeamPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Team');
    }

    public function view(AuthUser $authUser, Team $team): bool
    {
        return $authUser->can('View:Team');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Team');
    }

    public function update(AuthUser $authUser, Team $team): bool
    {
        return $authUser->can('Update:Team');
    }

    public function delete(AuthUser $authUser, Team $team): bool
    {
        return $authUser->can('Delete:Team');
    }

}
