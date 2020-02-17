<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function detail()
    {
        $good_id = request()->get('id');
        echo "goods_id" .$goods_id;
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $data = [
            'goods_id'  => $goods_id,
            'ua'    => $ua,
            'ip'    =>$_SERVER['REMOTE_ADDR']
        ];
        $id = GoodsStatisticModel::insertGetId($data);
        var_dump($id);
    }
}
