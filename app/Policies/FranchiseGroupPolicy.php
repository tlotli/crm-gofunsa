<?php

namespace GoFunCrm\Policies;

use GoFunCrm\User;
use GoFunCrm\Franchise;
use Illuminate\Auth\Access\HandlesAuthorization;

class FranchiseGroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the franchise.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Franchise  $franchise
     * @return mixed
     */
    public function view(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 29) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can create franchises.
     *
     * @param  \GoFunCrm\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 30) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can update the franchise.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Franchise  $franchise
     * @return mixed
     */
    public function update(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 31) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can delete the franchise.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Franchise  $franchise
     * @return mixed
     */
    public function delete(User $user, Franchise $franchise)
    {
        //
    }

    /**
     * Determine whether the user can restore the franchise.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Franchise  $franchise
     * @return mixed
     */
    public function restore(User $user, Franchise $franchise)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the franchise.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Franchise  $franchise
     * @return mixed
     */
    public function forceDelete(User $user, Franchise $franchise)
    {
        //
    }
}
