<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['type', 'path', 'avatar', 'introduction'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
