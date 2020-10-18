<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class province extends Model
{
    protected $fillable=['name'];
    protected $hidden=['created_at','updated_at'];



    public function post()
    {
        return $this->hasMany('App\models\post','province_id');
    }

   
}
