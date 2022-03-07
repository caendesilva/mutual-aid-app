<?php

namespace App\Policies;

use App\Models\User;

/**
 * Reusable Policy Rules
 */
class BasePolicy
{
	/**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     * If you want to handle this on a per model basis,
     * such as if we implement moderating tools to hide
     * posts from anyone who is not a moderator, you will
     * need to override this method, and supply the model as
     * a parameter in the model policy class.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user)
    {
        return true;
    }


	/**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }
}
