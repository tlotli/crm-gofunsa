<?php

namespace GoFunCrm\Policies;

use GoFunCrm\User;
use GoFunCrm\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the task.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Task  $task
     * @return mixed
     */
    public function view(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can create tasks.
     *
     * @param  \GoFunCrm\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the task.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Task  $task
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Task  $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can restore the task.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Task  $task
     * @return mixed
     */
    public function restore(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the task.
     *
     * @param  \GoFunCrm\User  $user
     * @param  \GoFunCrm\Task  $task
     * @return mixed
     */
    public function forceDelete(User $user, Task $task)
    {
        //
    }

    public function visitations_not_assigned(User $user) {
	    foreach($user->roles as $role) {
		    foreach($role->permissions as $permission) {
			    if($permission->id == 25) {
				    return true;
			    }
		    }
	    }
	    return false;
    }

	public function visitations_assigned(User $user) {
		foreach($user->roles as $role) {
			foreach($role->permissions as $permission) {
				if($permission->id == 33) {
					return true;
				}
			}
		}
		return false;
	}


	public function assigned_tasks(User $user) {
		foreach($user->roles as $role) {
			foreach($role->permissions as $permission) {
				if($permission->id == 26) {
					return true;
				}
			}
		}
		return false;
	}

}
