<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MailingList;
use Illuminate\Auth\Access\HandlesAuthorization;

class MailingListPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the mailingList.
     *
     * @param  \App\Models\User $user
     * @param MailingList $mailingList
     * @return mixed
     */
    public function view(User $user, MailingList $mailingList)
    {
        return $user->id === $mailingList->user_id;
    }

    /**
     * Determine whether the user can update the mailingList.
     *
     * @param  \App\Models\User $user
     * @param MailingList $mailingList
     * @return mixed
     */
    public function update(User $user, MailingList $mailingList)
    {
        return $user->id === $mailingList->user_id;
    }

    /**
     * Determine whether the user can delete the mailingList.
     *
     * @param  \App\Models\User $user
     * @param MailingList $mailingList
     * @return mixed
     */
    public function delete(User $user, MailingList $mailingList)
    {
        return $user->id === $mailingList->user_id;
    }

    /**
     * Determine whether the user can send the mailingList.
     *
     * @param  \App\Models\User $user
     * @param MailingList $mailingList
     * @return mixed
     */
    public function send(User $user, MailingList $mailingList)
    {
        return $user->id === $mailingList->user_id;
    }

    /**
     * Determine whether the user can export the mailingList.
     *
     * @param  \App\Models\User $user
     * @param MailingList $mailingList
     * @return mixed
     */
    public function export(User $user, MailingList $mailingList)
    {
        return $user->id === $mailingList->user_id;
    }

    /**
     * Determine whether the user can import the mailingList.
     *
     * @param  \App\Models\User $user
     * @param MailingList $mailingList
     * @return mixed
     */
    public function imoort(User $user, MailingList $mailingList)
    {
        return $user->id === $mailingList->user_id;
    }
}
