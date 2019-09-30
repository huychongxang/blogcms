<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 'slug'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Relationships
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
