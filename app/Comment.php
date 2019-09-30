<?php

namespace App;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_name', 'user_email', 'user_url', 'body', 'post_id'];

    //Relationships
    public function posts()
    {
        return $this->belongsTo(Post::class);
    }

    // Accessors- Mutators
    public function getDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getBodyHtmlAttribute()
    {
        return Markdown::convertToHtml(e($this->body));
    }
}
