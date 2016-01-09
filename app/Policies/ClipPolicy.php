<?php

namespace App\Policies;

use App\User;
use App\Clip;

use Illuminate\Auth\Access\HandlesAuthorization;

class ClipPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given user can delete the given task.
     *
     * @param  User  $user
     * @param  Task  $task
     * @return bool
     */
    public function destroy(User $user, Clip $clip)
    {
        return $user->id === $clip->user_id;
    }

}
