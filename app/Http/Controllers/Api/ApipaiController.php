<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApipaiController extends Controller
{
    
    public function test1()
    {
        echo __METHOD__;

        $client = new Client();

        $url = 'https://openapi.alipaydev.com/gateway.do';  //沙箱环境

        //请求参数
        $common_paray = [
            'out_trade_no'  =>  'test1906'.time().'_'.mt_rand(11111,99999),
            'product_code'  =>  'FAST_INSTANT_TRADE_PAY',
            'tota_amount'   =>  '0.01',
            'subject'   =>  '测试订单 :'.mt_rand(11111,99999),
        ];

        $pub_param = [
            'app_id' => env('ALIPAY_APPID'),
            'method'    => 'apipay.trade.page.pay',
            'charset'   =>  'utf-8',
            'sign_type'     => 'RSA2',
            'sign'  =>  '',
            'timestamp' => 'date("Y-m-d H:i:s")',
            'version'   =>  '1.0',
            'biz_content'   =>  'json_encode($common_param'
        ];

        $params = array_merge($common_param,$pub_param);
        echo "排序前 <pre>";print_r($params);echo "</pre>";
        
        // 1 筛选并排序

        sort($params);
        echo "排序后: <pre>";print_r($params);echo "</pre>";die;
        echo "<pre>";print_r($_POST);echo "</pre>";

        // 2 拼接得到代签名字符串

        $str = "";
        foreach($params as $k=>$v){
            $str .= $k .'='.$v .'&';
        }
        $str = rtrim($str,'&');
        echo "代签名字符串" .$str;die;

        // 3 调用签名函数
        $priv_key_id = file_get_contents("file://".storage_path('keys/priv_ali'));
        openssl_sign($str,$sign,$priv_key_id,OPENSSL_ALGO_SHA256);

        echo "签名 sign :".$sign;die;
        echo "base64 :" .base64_encode($sign);die;
        $signature = base64_encode($sign);

        //将签名加入 url 参数中


        // $client->request('');
        $request_url = $url . '?' .$str . '&sign='.$signature;

        echo "request_url :" .$request_url;

        header("Location:".$request_url);
        die;
    }
}
