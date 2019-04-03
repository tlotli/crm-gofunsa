<?php

namespace GoFunCrm\Policies;

use GoFunCrm\User;
use GoFunCrm\QuantitySold;
use Illuminate\Auth\Access\HandlesAuthorization;

class StockPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the quantity sold.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\QuantitySold  $quantitySold
     * @return mixed
     */
    public function view(User $user)
    {

    }

    /**
     * Determine whether the user can create quantity solds.
     *
     * @param  \GoFunCrm\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 20) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can update the quantity sold.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\QuantitySold  $quantitySold
     * @return mixed
     */
    public function update(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 21) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can delete the quantity sold.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\QuantitySold  $quantitySold
     * @return mixed
     */
    public function delete(User $user, QuantitySold $quantitySold)
    {
        //
    }

    /**
     * Determine whether the user can restore the quantity sold.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\QuantitySold  $quantitySold
     * @return mixed
     */
    public function restore(User $user, QuantitySold $quantitySold)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the quantity sold.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\QuantitySold  $quantitySold
     * @return mixed
     */
    public function forceDelete(User $user, QuantitySold $quantitySold)
    {
        //
    }
}
