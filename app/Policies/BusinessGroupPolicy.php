<?php

namespace GoFunCrm\Policies;

use GoFunCrm\User;
use GoFunCrm\BusinessGroup;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessGroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the business group.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\BusinessGroup  $businessGroup
     * @return mixed
     */
    public function view(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 8) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can create business groups.
     *
     * @param  \GoFunCrm\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 9) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can update the business group.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\BusinessGroup  $businessGroup
     * @return mixed
     */
    public function update(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 10) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can delete the business group.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\BusinessGroup  $businessGroup
     * @return mixed
     */
    public function delete(User $user, BusinessGroup $businessGroup)
    {
        //
    }

    /**
     * Determine whether the user can restore the business group.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\BusinessGroup  $businessGroup
     * @return mixed
     */
    public function restore(User $user, BusinessGroup $businessGroup)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the business group.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\BusinessGroup  $businessGroup
     * @return mixed
     */
    public function forceDelete(User $user, BusinessGroup $businessGroup)
    {
        //
    }
}
