<?php

namespace App\Http\Controllers\Api;

use App\Transformers\PermissionTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionsController extends BaseController
{
    //
    public function index(){
        $permissions = $this->user()->getAllPermissions();
        return $this->response->collection($permissions, new PermissionTransformer());
    }
}
