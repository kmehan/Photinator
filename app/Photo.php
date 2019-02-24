<?php

namespace Photinator;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //Add Many to One Relation to User Model
    public function user() {
      return $this->belongsTo('Photinator\User','user_id','id');
    }
}
