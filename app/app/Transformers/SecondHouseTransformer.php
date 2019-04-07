<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/1
 * Time: 23:10
 */

namespace App\Transformers;

use App\Models\SecondHouse;
use League\Fractal\TransformerAbstract;

class SecondHouseTransformer extends TransformerAbstract
{
    public function transform(SecondHouse $secondhouse){


        return [
            'id' => $secondhouse->id,
            'title' => $secondhouse->title,
            'room' => $secondhouse->room,
            'ting' => $secondhouse->ting,
            'wei'  => $secondhouse->wei,
            'chu'  => $secondhouse->chu,
            'yang' => $secondhouse->yang,
            'price' => $secondhouse->price,
            'total_price' => $secondhouse->total_price,
            'mianji' => $secondhouse->mianji,
            'floor' => $secondhouse->floor,
            'total_floor' => $secondhouse->total_floor,
            'niandai' => $secondhouse->niandai,
            'address' => $secondhouse->address,
            'lat' => $secondhouse->lat,
            'lng' => $secondhouse->lng,
            'info' => $secondhouse->info,
            'contact' => $secondhouse->contact,
            'contact_phone' => $secondhouse->contact_phone,
            'ordid' => $secondhouse->ordid,
            'hits' => $secondhouse->hits,
        ];
    }
}
