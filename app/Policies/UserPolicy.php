<?php

namespace GoFunCrm\Policies;

use GoFunCrm\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \GoFunCrm\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        foreach($user->roles as $role) {
        	foreach($role->permissions as $permission) {
        		if($permission->id == 2) {
        			return true;
		        }
	        }
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\User  $model
     * @return mixed
     */
    public function update(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 3) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\User  $model
     * @return mixed
     */
    public function delete(User $user)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }


	public function reset_password(User $user)
	{
		foreach($user->roles as $role) {
			foreach($role->permissions as $permission) {
				if($permission->id == 4) {
					return true;
				}
			}
		}
		return false;
	}

	public function view_users(User $user)
	{
		foreach($user->roles as $role) {
			foreach($role->permissions as $permission) {
				if($permission->id == 1) {
					return true;
				}
			}
		}
		return false;
	}

}
