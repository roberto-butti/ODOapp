<?php

namespace App\Repositories;

use App\User;
use App\Clip;

class ClipRepository
{
    /**
     * Get all of the clips for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Clip::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    /**
     * Get all of the clips for the following user of a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forFollowingUser(User $user)
    {
        return Clip::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}