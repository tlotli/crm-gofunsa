<?php

namespace GoFunCrm\Policies;

use GoFunCrm\User;
use GoFunCrm\Site;
use Illuminate\Auth\Access\HandlesAuthorization;

class SitePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the site.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Site  $site
     * @return mixed
     */
    public function view(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 16) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can create sites.
     *
     * @param  \GoFunCrm\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 17) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can update the site.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Site  $site
     * @return mixed
     */
    public function update(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 18) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can delete the site.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Site  $site
     * @return mixed
     */
    public function delete(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 37) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can restore the site.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Site  $site
     * @return mixed
     */
    public function restore(User $user)
    {

	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 38) {
				    return true;
			    }
		    }
	    }
	    return false;

    }

    /**
     * Determine whether the user can permanently delete the site.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Site  $site
     * @return mixed
     */
    public function forceDelete(User $user)
    {

	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 37) {
				    return true;
			    }
		    }
	    }
	    return false;
    }



    public function restore_sites(User $user) {

	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 38) {
				    return true;
			    }
		    }
	    }
	    return false;

    }


}
