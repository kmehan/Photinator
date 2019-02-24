<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //Add Many to One Relation to User Model
    public function user() {
      return $this->belongsTo('App\User','user_id','id');
    }
}
