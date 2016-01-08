<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clip extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['caption', 'url_clip'];


    /**
     * Get the user that owns the clip.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
