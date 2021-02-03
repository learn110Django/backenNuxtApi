<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Like;
use App\User;
class Like extends Model
{
    public function likeable(){
        return $this->morphTo();
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
