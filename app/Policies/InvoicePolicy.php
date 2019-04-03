<?php

namespace GoFunCrm\Policies;

use GoFunCrm\User;
use GoFunCrm\Invoice;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the invoice.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Invoice  $invoice
     * @return mixed
     */
    public function view(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 34) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can create invoices.
     *
     * @param  \GoFunCrm\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 35) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can update the invoice.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Invoice  $invoice
     * @return mixed
     */
    public function update(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 36) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can delete the invoice.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Invoice  $invoice
     * @return mixed
     */
    public function delete(User $user, Invoice $invoice)
    {
        //
    }

    /**
     * Determine whether the user can restore the invoice.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Invoice  $invoice
     * @return mixed
     */
    public function restore(User $user, Invoice $invoice)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the invoice.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Invoice  $invoice
     * @return mixed
     */
    public function forceDelete(User $user, Invoice $invoice)
    {
        //
    }
}
