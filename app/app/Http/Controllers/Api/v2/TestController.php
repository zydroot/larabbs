<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Api\Controller;

class TestController extends Controller{

    public function index(){
        $reflector = new \ReflectionClass('App\User');
        $constructor = $reflector->getConstructor();

        $dependencies = $constructor->getParameters();
        dd($reflector->newInstance());
    }
}