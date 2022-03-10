<?php

namespace App\Policies;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * @deprecated
 */
class OfferPolicy extends BasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Offer $offer)
    {
        return $user->isAdmin || $user->id === $offer->user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Offer $offer)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Offer $offer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Offer $offer)
    {
        //
    }
}
