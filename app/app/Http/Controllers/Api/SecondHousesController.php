<?php

namespace App\Http\Controllers\Api;

use App\Models\SecondHouse;
use App\Transformers\SecondHouseTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SecondHousesController extends BaseController
{
    //
    public function index(){
        $secondHouses = SecondHouse::paginate(15);
        return $this->response->paginator($secondHouses, new SecondHouseTransformer());
    }

    public function show($secondHouse_id){

        $secondHouse = SecondHouse::find($secondHouse_id);
        
        return $this->response->item($secondHouse, new SecondHouseTransformer());
    }
}
