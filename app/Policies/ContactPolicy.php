<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\FrontPage\Contact;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class ContactPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Contact');
    }

    public function view(AuthUser $authUser, Contact $contact): bool
    {
        return $authUser->can('View:Contact');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Contact');
    }

    public function update(AuthUser $authUser, Contact $contact): bool
    {
        return $authUser->can('Update:Contact');
    }

    public function delete(AuthUser $authUser, Contact $contact): bool
    {
        return $authUser->can('Delete:Contact');
    }

}
