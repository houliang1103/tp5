<?php

namespace app\wechat\controller;

use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Text;
use think\Controller;
use EasyWeChat\Message\News;
class MsgController extends Controller
{
    //
    public function server(){

        $app = new Application(config('weixin'));

        $app->server->setMessageHandler(function ($message) {
            switch ($message->Content) {
                case '美女':
                    $girls = [
                        ['title'=>'赵丽颖','description'=>'中国内地影视女演员','picurl'=>'https://img.mp.itc.cn/upload/20170331/c7921a6215234a9eb5269f59bc120cb6_th.jpg','url'=>'https://www.sohu.com/a/131266878_384578'],
                        ['title'=>'刘诗诗','description'=>'刘诗诗','picurl'=>'https://img.mp.itc.cn/upload/20170331/aa5751c62d894a2ea1b7c388163bc15d_th.jpg','url'=>'https://www.sohu.com/a/131266878_384578'],
                        ['title'=>'张梓琳','description'=>'张梓琳张梓琳','picurl'=>'https://img.mp.itc.cn/upload/20170331/ce0423b0d39444c7a26a3f338cc6b4ec_th.jpg','url'=>'https://www.sohu.com/a/131266878_384578'],
                        ['title'=>'刘亦菲','description'=>'刘亦菲刘亦菲','picurl'=>'https://img.mp.itc.cn/upload/20170331/f924af1bb89748f7afcc4b5c1e8af52b_th.jpg','url'=>'https://www.sohu.com/a/131266878_384578'],
                    ];
                    foreach ($girls as $girl){
                        $news[] = new News([
                            'title'       => $girl['title'],
                            'description' => $girl['description'],
                            'url'         => $girl['url'],
                            'image'       => $girl['picurl'],
                        ]);
                    }
                    return $news;
                    break;
                case '订单':
                    $app = new Application(config('weixin'));
                    $notice = $app->notice;
                    $userId = 'oEbKH1ftkk-QpjAnjR7HP7txpxJ0';
                    $templateId = 'qpcGi5EF9H_memgD4HzWAENTyCIykO1vV6jEuaELz2g';
                    $url = 'http://baidu.com';
                    $data = array(
                        "first"  => "恭喜你购买成功！",
                        "name"   => "周黎",
                        "price"  => "1元",
                        "remark" => "欢迎再次购买！",
                    );
                    $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();
                    break;
                default:

                    $tqXml = file_get_contents('http://flash.weather.com.cn/wmaps/xml/chongqing.xml');
                    $weatherXml = simplexml_load_string($tqXml);
                    $weather = '未知城市';
                    foreach ( $weatherXml as $value){
                        if ($value['cityname']==$message->Content){
                            $weather = $value['stateDetailed'];
                        }
                    }

                    $text = new Text();
                    return $text->content = (string)$weather;
                    break;
            }
        });
        $response = $app->server->serve();
        // 将响应输出
        $response->send(); // Laravel 里请使用：return $response;

    }

    public static function moban(){

        $app = new Application(config('weixin'));
        $notice = $app->notice;
        $userId = 'oEbKH1ftkk-QpjAnjR7HP7txpxJ0';
        $templateId = 'qpcGi5EF9H_memgD4HzWAENTyCIykO1vV6jEuaELz2g';
        $url = 'http://baidu.com';
        $data = array(
            "first"  => "恭喜你购买成功！",
            "name"   => "周黎",
            "price"  => "1元",
            "remark" => "欢迎再次购买！",
        );
        $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();

    }

}
