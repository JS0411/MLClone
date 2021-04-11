<?php

namespace App\Policies;

use App\Reputation;
use App\User;
use App\Purchase;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReputationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reputation  $reputation
     * @return mixed
     */
    public function view(User $user, Reputation $reputation)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Purchase $purchase)
    {
        /*Allows the user to create a rating as long as they match the ID
         *in purchase while said purchase is active and they havent rated yet*/
        if (request()->mode == 'bought') {
            return (($user->id == $purchase->buyerProfiles->first()->user->id)
                && !($purchase->buyer_rated)
                && $purchase->active);
        } elseif (request()->mode == 'sold') {
            return (($user->id == $purchase->sellerProfiles->first()->user->id)
                && !($purchase->seller_rated)
                && $purchase->active);
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reputation  $reputation
     * @return mixed
     */
    public function update(User $user, Reputation $reputation)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reputation  $reputation
     * @return mixed
     */
    public function delete(User $user, Reputation $reputation)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reputation  $reputation
     * @return mixed
     */
    public function restore(User $user, Reputation $reputation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reputation  $reputation
     * @return mixed
     */
    public function forceDelete(User $user, Reputation $reputation)
    {
        //
    }
}
