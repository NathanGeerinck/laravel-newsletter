<?php

namespace App\Policies;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampaignPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the campaign.
     *
     * @param  \App\Models\User $user
     * @param Campaign $campaign
     * @return mixed
     */
    public function view(User $user, Campaign $campaign)
    {
        return $user->id === $campaign->user_id;
    }

    /**
     * @param User $user
     * @param Campaign $campaign
     * @return bool
     */
    public function edit(User $user, Campaign $campaign)
    {
        return $user->id === $campaign->user_id;
    }

    /**
     * Determine whether the user can update the campaign.
     *
     * @param  \App\Models\User $user
     * @param Campaign $campaign
     * @return mixed
     */
    public function update(User $user, Campaign $campaign)
    {
        return $user->id === $campaign->user_id;
    }

    /**
     * Determine whether the user can delete the campaign.
     *
     * @param  \App\Models\User $user
     * @param Campaign $campaign
     * @return mixed
     */
    public function delete(User $user, Campaign $campaign)
    {
        return $user->id === $campaign->user_id;
    }

    /**
     * @param User $user
     * @param Campaign $campaign
     * @return bool
     */
    public function export(User $user, Campaign $campaign)
    {
        return $user->id === $campaign->user_id;
    }

    /**
     * @param User $user
     * @param Campaign $campaign
     * @return bool
     */
    public function send(User $user, Campaign $campaign)
    {
        return $user->id === $campaign->user_id;
    }
}