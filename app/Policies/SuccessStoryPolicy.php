<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\FrontPage\SuccessStory;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class SuccessStoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SuccessStory');
    }

    public function view(AuthUser $authUser, SuccessStory $successStory): bool
    {
        return $authUser->can('View:SuccessStory');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SuccessStory');
    }

    public function update(AuthUser $authUser, SuccessStory $successStory): bool
    {
        return $authUser->can('Update:SuccessStory');
    }

    public function delete(AuthUser $authUser, SuccessStory $successStory): bool
    {
        return $authUser->can('Delete:SuccessStory');
    }

}
