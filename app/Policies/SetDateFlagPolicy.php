<?php

namespace GoFunCrm\Policies;

use GoFunCrm\User;
use GoFunCrm\SetDateFlag;
use Illuminate\Auth\Access\HandlesAuthorization;

class SetDateFlagPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the set date flag.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\SetDateFlag  $setDateFlag
     * @return mixed
     */
    public function view(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 27) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can create set date flags.
     *
     * @param  \GoFunCrm\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the set date flag.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\SetDateFlag  $setDateFlag
     * @return mixed
     */
    public function update(User $user, SetDateFlag $setDateFlag)
    {
        //
    }

    /**
     * Determine whether the user can delete the set date flag.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\SetDateFlag  $setDateFlag
     * @return mixed
     */
    public function delete(User $user, SetDateFlag $setDateFlag)
    {
        //
    }

    /**
     * Determine whether the user can restore the set date flag.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\SetDateFlag  $setDateFlag
     * @return mixed
     */
    public function restore(User $user, SetDateFlag $setDateFlag)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the set date flag.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\SetDateFlag  $setDateFlag
     * @return mixed
     */
    public function forceDelete(User $user, SetDateFlag $setDateFlag)
    {
        //
    }
}
