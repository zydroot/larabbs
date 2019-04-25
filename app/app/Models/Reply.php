<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function topic(){
        return $this->belongsTo(Topic::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
