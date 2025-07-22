<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostLike extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'post_id'
    ];

    public function get_user_is_like($snUserId, $snPostId)
    {
        $saLike = PostLike::where('user_id', $snUserId)->where('post_id', $snPostId)->first();
        if (empty($saLike)) {
            return 2;
        } else {
            return 1;
        }
    }
}
