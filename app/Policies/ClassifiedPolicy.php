<?php

namespace App\Policies;

use App\Classified;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassifiedPolicy
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
     * @param  \App\Classified  $classified
     * @return mixed
     */
    public function view(User $user, Classified $classified)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Classified  $classified
     * @return mixed
     */
    public function update(User $user, Classified $classified)
    {
        return ($classified->seller_profile_id == $user->sellerProfile->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Classified  $classified
     * @return mixed
     */
    public function delete(User $user, Classified $classified)
    {
        return ($classified->seller_profile_id == $user->sellerProfile->id);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Classified  $classified
     * @return mixed
     */
    public function restore(User $user, Classified $classified)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Classified  $classified
     * @return mixed
     */
    public function forceDelete(User $user, Classified $classified)
    {
        //
    }
}
