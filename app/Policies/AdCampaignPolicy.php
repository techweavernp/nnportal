<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AdCampaign;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdCampaignPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AdCampaign');
    }

    public function view(AuthUser $authUser, AdCampaign $adCampaign): bool
    {
        return $authUser->can('View:AdCampaign');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AdCampaign');
    }

    public function update(AuthUser $authUser, AdCampaign $adCampaign): bool
    {
        return $authUser->can('Update:AdCampaign');
    }

    public function delete(AuthUser $authUser, AdCampaign $adCampaign): bool
    {
        return $authUser->can('Delete:AdCampaign');
    }

}