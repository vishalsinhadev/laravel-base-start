<?php

namespace App\Models\Post;

use App\Models\Followers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'image',
        'owner_name',
        'decription',
        'tag',
        'filter'
    ];

    public function getLikeCount()
    {
        return PostLike::where([
            'post_id' => $this->id
        ])->count();
    }

    public function getCommentCount()
    {
        return PostComment::where([
            'post_id' => $this->id
        ])->count();
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function userDetail()
    {
        return $this->hasOne('App\Models\UserDetail', 'user_id', 'user_id');
    }

    static public function getAll($count = false)
    {
        $post = Post::orderBy('id', 'DESC');
        if ($count === true) {
            return $post->count();
        }
        return $post->get();
    }

    static public function getByFilterAndFollower($count = false, $filter, $user)
    {
        $post = Post::where('filter_id', '<=', $filter)->whereIn('user_id', function ($query) use ($user) {
            $query->select('follewers_id')
                ->from(with(new Followers())->getTable())
                ->where('user_id', $user->id);
        })
            ->orderBy('id', 'DESC');
        if ($count === true) {
            return $post->count();
        }
        return $post->get();
    }

    static public function getGuestPost($count = false)
    {
        $post = Post::where('filter_id', 1)->orderBy('id', 'DESC');
        if ($count === true) {
            return $post->count();
        }
        return $post->get();
    }
}
