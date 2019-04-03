<?php

namespace GoFunCrm\Policies;

use GoFunCrm\User;
use GoFunCrm\BusinessOwner;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessOwnerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the business owner.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\BusinessOwner  $businessOwner
     * @return mixed
     */
    public function view(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 13) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can create business owners.
     *
     * @param  \GoFunCrm\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 14) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can update the business owner.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\BusinessOwner  $businessOwner
     * @return mixed
     */
    public function update(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 15) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can delete the business owner.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\BusinessOwner  $businessOwner
     * @return mixed
     */
    public function delete(User $user, BusinessOwner $businessOwner)
    {
        //
    }

    /**
     * Determine whether the user can restore the business owner.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\BusinessOwner  $businessOwner
     * @return mixed
     */
    public function restore(User $user, BusinessOwner $businessOwner)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the business owner.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\BusinessOwner  $businessOwner
     * @return mixed
     */
    public function forceDelete(User $user, BusinessOwner $businessOwner)
    {
        //
    }
}
