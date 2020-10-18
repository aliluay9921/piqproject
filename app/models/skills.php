<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class skills extends Model
{   
    
    protected $fillable=[
        'title','image'
    ];
    protected $hidden=['created_at','updated_at','pivot'];


    public function post()
    {
        return $this->belongsToMany('App\models\post', 'user_skills', 'skills_id', 'post_id');
    }
}
