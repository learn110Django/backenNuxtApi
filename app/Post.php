<?php

namespace App;
use App\Topic;
use App\User;
use App\Like;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected  $fillable =['body'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function topic(){
        return $this->belongsTo(Topic::class);
    }
    public function likes(){
        return $this->morphMany(Like::class,'likeable');
    }
}
