<?php

namespace App\Http\Controllers\Api;

use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends BaseController
{
    //
    public function me(){

        return $this->response->item($this->user(), new UserTransformer());
    }
}
