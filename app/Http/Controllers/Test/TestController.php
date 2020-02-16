<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Guzzle\Cilent;
 
// use Illuminate\Http\Client;


class TestController extends Controller
{
    public function access_token()
    {
        $appid = "wx862686ded89ed2cd";
        $appsecret = "5df895759d47f1ae4511f36ad8bbe960";
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
        echo $url;
        //使用file_get_contents发起get请求
    
        $response = file_get_contents($url);
        var_dump($response);
        $arr = json_decode($response,true);
        var_dump($arr);
    }
    public function curl1()
    {
        $appid = "wx862686ded89ed2cd";
        $appsecret = "5df895759d47f1ae4511f36ad8bbe960";
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
        // echo $url;
        //初始化
        $ch = curl_init($url);
        //设置参数
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //执行会话
        $response = curl_exec($ch);

        //捕获错误
        $errno = curl_error($ch);
        $error = curl_error($ch);
        if($errno > 0){
            echo "错误码".$errno;
            echo "错误信息".$error;
            die;
        }
        

        // var_dump($error);die;

        //关闭会话
        curl_close($ch);

        // echo "服务器响应数据";
        // echo $response;
        $arr = json_encode($response);
        echo $arr;

    }
    public function guzzle(){
        $appid = "wx862686ded89ed2cd";
        $appsecret = "5df895759d47f1ae4511f36ad8bbe960";
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;

        $client = new Client();
        $response = $client->request('GET',$url);
        // dd($response);
        $data = $response->getBody();
        echo $data;
    }
    public function curl2()
    {
        $access_token = "30_vMtRvSfmtSQFs-R7g2zHjCIR61qIpbzo9WlCyzU0GFT8sMmRCXr_BZyu9UcuAkF7gFN160KNtkU3Bv9p_8Qashi8_pAAskaE7R7zP75KmobBGTj2b5c6g-lDkVCa2utl3uWyTJvSvv97D1CSJWFgADAQDM";
        $url = " https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        $menu = [
            [
                "button"    => [
                    "type" => "click",
                    "name" => "CURL",
                    "key"  => "curl001"
                ]
            ]
        ];
        //初始化
        $ch = curl_init($url);
        //设置参数
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //POST请求
        curl_setopt($ch,CURLOPT_PORT,true);
        //发送json数据  用form-data形式
        culr_setopt($ch,CURLOPT_HTTPHEADER,['Content-Typr:application/json']);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($menu));

         //执行会话
         $response = curl_exec($ch);
        
         //捕获错误
         $errno = curl_error($ch);
         $error = curl_error($ch);
         if($errno > 0){
             echo "错误码".$errno;
             echo "错误信息".$error;
             die;
         }

          //关闭会话
          curl_close($ch);
         
    }
    public function post1()
    {
        echo "我是API 开始";
        echo print_r($_POST);
        echo "我是API 结束";
    }
    public function post2()
    {
        $json =file_decode($json,true);
        echo $arr;
    }
    public function curlPost3()
    {
        $user_info = [
            'user_name' => "zhangsan",
            "password"  => '123456' 
        ];
        $json = json_encode($user_info);
        $url = "http://1906api.com/wx/post1";
        //初始化 
        $ch = curl_init($url);

        //设置参数
          curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch,CURLOPT_POST,1);
          curl_setopt($ch,CURLOPT_POSTFIELDS,$user_info);
           //执行会话
         $response = curl_exec($ch);
        
         //捕获错误
         $errno = curl_error($ch);
        //  $error = curl_error($ch);
         if($errno > 0){
             echo curl_error();
             die;
         }

          //关闭会话
          curl_close($ch);
    }
    //访问接口  上传文件
    public function curlUpload()
    {
        $file_info = [
            'username' => "zhangsan",
            "email" => "3228682711@qq.com",
            'img' => new \CURLFile(storage_path("aaa.jgp")),
        ];
        $json = json_encode($user_info);
        $url = "http://1906api.com/wx/upload";
        //初始化 
        $ch = curl_init($url);

        //设置参数
          curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch,CURLOPT_POST,1);
          curl_setopt($ch,CURLOPT_POSTFIELDS,$user_info);
           //执行会话
         $response = curl_exec($ch);
        
         //捕获错误
         $errno = curl_error($ch);
        //  $error = curl_error($ch);
         if($errno > 0){
             echo "错误码" . $errno;die;
             echo curl_error();
             die;
         }

          //关闭会话
          curl_close($ch);
    }
    //
    public function testUpload()
    {
        echo "<pre>";print_r($_POST);echo "</pre>";
        echo "接收文件";echo "<br>";
        echo "<pre>";print_r($_FILES);echo "</pre>";
    }
    public function guzzleGet()
    {
        $client = new Client();
        $url = "http://1906api.com/wx/get1?aa=bb&cc=ddd";

        $response = $client->requst('GET',$curl,[
            'query_params'  =>[
                'user'  => 'zhangsan',
                'name'  =>  'hahah',
            ]
        ]);
        echo $response->getBody();//接收服务器
    }
    public function guzzlePost()
    {
        $client = new Client();
        $url = "http://1906api.com/wx/post1";
        $response = $client->request('POST',$url,[
            'multipart' => [
                [
                    'name'  => "user_name",
                    'comtents'  => "zhangsan"
                ]
            ]
        ]);

    }
}
