<?php

namespace GoFunCrm\Policies;

use GoFunCrm\User;
use GoFunCrm\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the event.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Event  $event
     * @return mixed
     */
    public function view(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 32) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can create events.
     *
     * @param  \GoFunCrm\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 22) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can update the event.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Event  $event
     * @return mixed
     */
    public function update(User $user)
    {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 23) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

    /**
     * Determine whether the user can delete the event.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Event  $event
     * @return mixed
     */
    public function delete(User $user, Event $event)
    {
        //
    }

    /**
     * Determine whether the user can restore the event.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Event  $event
     * @return mixed
     */
    public function restore(User $user, Event $event)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the event.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Event  $event
     * @return mixed
     */
    public function forceDelete(User $user, Event $event)
    {
        //
    }
}
