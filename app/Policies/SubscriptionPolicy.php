<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the subscription.
     *
     * @param  \App\Models\User $user
     * @param Subscription $subscription
     * @return mixed
     */
    public function view(User $user, Subscription $subscription)
    {
        return $user->id === $subscription->user_id;
    }

    /**
     * Determine whether the user can update the subscription.
     *
     * @param  \App\Models\User $user
     * @param Subscription $subscription
     * @return mixed
     */
    public function update(User $user, Subscription $subscription)
    {
        return $user->id === $subscription->user_id;
    }

    /**
     * Determine whether the user can delete the subscription.
     *
     * @param  \App\Models\User $user
     * @param Subscription $subscription
     * @return mixed
     */
    public function delete(User $user, Subscription $subscription)
    {
        return $user->id === $subscription->user_id;
    }
}
