<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class PostDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'title',
        'description'
    ];
}
