<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AdList;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdListPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AdList');
    }

    public function view(AuthUser $authUser, AdList $adList): bool
    {
        return $authUser->can('View:AdList');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AdList');
    }

    public function update(AuthUser $authUser, AdList $adList): bool
    {
        return $authUser->can('Update:AdList');
    }

    public function delete(AuthUser $authUser, AdList $adList): bool
    {
        return $authUser->can('Delete:AdList');
    }

}