<?php

namespace GoFunCrm\Policies;

use GoFunCrm\User;
use GoFunCrm\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the role.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Role  $role
     * @return mixed
     */
    public function view(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 5) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \GoFunCrm\User  $user
     * @return mixed
     */
    public function create(User $user )
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 6) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Role  $role
     * @return mixed
     */
    public function update(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 7) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Role  $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can restore the role.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Role  $role
     * @return mixed
     */
    public function restore(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the role.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Role  $role
     * @return mixed
     */
    public function forceDelete(User $user, Role $role)
    {
        //
    }
}
