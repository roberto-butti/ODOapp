<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

/**
     * Get all of the clips for the user.
     */
    public function clips()
    {
        return $this->hasMany(Clip::class);
    }



    //get all the followers of the current user
    public function Followers()
    {
        return $this->belongsToMany('App\User', 'user_follower_list', 'user_id', 'follower_id'  );
    }

    //get all the Users this user is following
    public function FollowingList()
    {
        return $this->belongsToMany('App\User', 'user_follower_list', 'follower_id', 'user_id' );
    }

}
