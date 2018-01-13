<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Template;
use Illuminate\Auth\Access\HandlesAuthorization;

class TemplatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the template.
     *
     * @param  \App\Models\User $user
     * @param Template $template
     * @return mixed
     */
    public function view(User $user, Template $template)
    {
        return $user->id === $template->user_id;
    }

    /**
     * Determine whether the user can update the template.
     *
     * @param  \App\Models\User $user
     * @param Template $template
     * @return mixed
     */
    public function update(User $user, Template $template)
    {
        return $user->id === $template->user_id;
    }

    /**
     * Determine whether the user can delete the template.
     *
     * @param  \App\Models\User $user
     * @param Template $template
     * @return mixed
     */
    public function delete(User $user, Template $template)
    {
        return $user->id === $template->user_id;
    }
}
