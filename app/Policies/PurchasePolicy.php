<?php

namespace App\Policies;

use App\Purchase;
use App\User;
use App\Classified;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchasePolicy
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
     * @param  \App\Purchase  $purchase
     * @return mixed
     */
    public function view(User $user, Purchase $purchase)
    {
        if (request()->mode == 'bought') {
            return $user->id == $purchase->buyerProfiles->first()->user->id;
        } elseif (request()->mode == 'sold') {
            return $user->id == $purchase->sellerProfiles->first()->user->id;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $classified = Classified::findOrFail(request()->classified_id);
        return ($user->id != $classified->sellerProfile->user->id AND $classified->active);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Purchase  $purchase
     * @return mixed
     */
    public function update(User $user, Purchase $purchase)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Purchase  $purchase
     * @return mixed
     */
    public function delete(User $user, Purchase $purchase)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Purchase  $purchase
     * @return mixed
     */
    public function restore(User $user, Purchase $purchase)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Purchase  $purchase
     * @return mixed
     */
    public function forceDelete(User $user, Purchase $purchase)
    {
        //
    }
}
