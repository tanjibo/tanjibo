<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    function hasManyComments(){
        return $this->hasMany('App\Comment','article_id','id');
    }
}
