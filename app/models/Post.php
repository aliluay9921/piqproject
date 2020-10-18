<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillabel=[
        'Full_name','age','phone','description','approve'
    ];
    protected $hidden=['created_at','updated_at','pivot'];


    public function province()
    {
        return $this->belongsTo('App\models\province', 'province_id');
    }


    public function skills()
    {
        return $this->belongsToMany('App\models\skills', 'user_skills', 'post_id', 'skills_id');
    }
}
