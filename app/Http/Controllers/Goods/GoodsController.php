<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
use App\Model\Goods;

class GoodsController extends Controller
{
    public function detail()
    {

        $good_id = request()->get('id');  //商品ID

        $goods_key = 'str:goods:info'.$goods_id;


        //判断是否有缓存信息
        $cache = Redis::get();

       

        if($cache) {
            echo "无缓存";

        }else{
            echo "有缓存";

                $goods_info = Goods::where(['id'=>$goods_id])->first();
                echo "<pre>";print_r($goods_info->toArray());echo "</pre>";
                $arr = $goods_info->toArray();



                $j_goods_info = json_encode($goods_info);
                Redis::set($goods_key,$j_goods_info);
                Redis::expire($goods_key,5);
                echo "<pre>";print_r($goods_info);echo "</pre>";
        }

        die;

        echo "goods_id" .$goods_id;
        $ua = $_SERVER['HTTP_USER_AGENT'];
        echo "商品名";

        $data = [
            'goods_id'  => $goods_id,
            'ua'    => $ua,
            'ip'    =>$_SERVER['REMOTE_ADDR']
        ];
        $id = GoodsStatisticModel::insertGetId($data);
        var_dump($id);
        //计算统计信息
        $pv = GoodsStatisticModel::where(['goods_id' => $goods_id])->count();
        echo "当前pv";
        //TODO Laravek model 
    }
    /*
        获取当前完整URL地址
    */ 
    public function getUrl()
    {
        //协议
        $scheme = $_SERVER['REQUEST_SEHEME'];
        //域名
        $host = $_SERVER['HTTP_HOST'];
        //请求URI
        $uri = $_SERVER['REQUEST_URI'];

        $url = $scheme . '://' .$host .$uri;

        echo '当前URL: '.$url;echo "<hr>";

        echo "<pre>";print_r($_SERVER);echo "</pre>";
    }
    public function redisStr1(){
        //$key = 'name';
        //$val = 'zhangsan';
        //Redis::set($key,$val);die;
        // $token = 'ahdbaj';
        // $key = 'user_token';
        $goods_info = [
            'id' => 14815,
            'goods_name'    => 'IphomeX',
            'price'     => 800000,
            'img'   => 'uyahuvdaji',
        ];
        //写入值
        Redis::set($key,$token); // 等价于 
        //设置过期时间
        Redis::expire($ket,15); //expire
    }
}
