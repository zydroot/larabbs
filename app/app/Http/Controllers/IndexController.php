<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/17
 * Time: 14:59
 */

namespace App\Http\Controllers;

use App\Models\FangBusinessSecond;
use Dingo\Api\Http\Request;

class IndexController extends BaseController
{
    function test(){
        echo "test";
        $seconds = FangBusinessSecond::all();
        return $this->response->error('This is an error.', 404);

    }
    function Login(Request $request){
        $data = $request->input('.');
    }
}
