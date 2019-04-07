<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Winxin extends Model implements JWTSubject
{
    //
    protected $table    = 'fang_weixin';

    protected $fillable = ['openid', 'session_key', 'nick_name', 'avatar_url', 'province', 'city'];


    function getJWTIdentifier(){
        return $this->getKey();
    }

    function getJWTCustomClaims(){
        return [];
    }
}
