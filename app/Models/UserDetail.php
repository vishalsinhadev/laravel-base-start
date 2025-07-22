<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use DB;

class UserDetail extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'filter',
        'category',
        'private_description',
        'privete_profile_url',
        'private_url1',
        'private_url2',
        'private_url3',
        'profile_image_url',
        'description',
        'image_url1',
        'image_url2',
        'image_url3'
    ];
}
