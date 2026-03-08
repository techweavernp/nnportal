<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\FrontPage\Message;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class MessagePolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Message');
    }

    public function view(AuthUser $authUser, Message $message): bool
    {
        return $authUser->can('View:Message');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Message');
    }

    public function update(AuthUser $authUser, Message $message): bool
    {
        return $authUser->can('Update:Message');
    }

    public function delete(AuthUser $authUser, Message $message): bool
    {
        return $authUser->can('Delete:Message');
    }

}
