<?php

namespace app\wx\controller;

use app\wx\model\Goods;
use app\wx\model\User;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\News;
use EasyWeChat\Message\Text;
use think\Controller;
use think\Db;

class ServerController extends Controller
{
    //
    public function index(){
        $app = new Application(config('weixin'));

        $app->server->setMessageHandler(function ($message) {
            if ($message->Event=='subscribe'){
                $text = new Text();
                return $text->content = '欢迎关注宇宙最好的语言PHP---';
            }
            if ($message->EventKey==='hotGoods' || $message->Content==="热卖商品"){
                $goods =Db::name('goods')->alias('a')
                    ->join('goods_intro b','a.id=b.goods_id')
                    ->limit('5')
                    ->order('a.id desc')->select();
                $news =[];
                foreach ($goods as $good){
                    $new = new News([
                        'title'       => $good['name'],
                        'description' => $good['content'],
                        'url'         => 'http://www.hou1103.cn/goods/detail?id='.$good['id'],
                        'image'       => $good['logo'],
                    ]);
                    $news[]=$new;
                }
                return $news;
            }
            switch ($message->Content) {
                case '美女':
                    $girls = [
                        ['title'=>'赵丽颖','description'=>'中国内地影视女演员','picur'=>'https://img.mp.itc.cn/upload/20170331/c7921a6215234a9eb5269f59bc120cb6_th.jpg','url'=>'https://www.sohu.com/a/131266878_384578'],
                        ['title'=>'刘诗诗','description'=>'刘诗诗','picur'=>'https://img.mp.itc.cn/upload/20170331/aa5751c62d894a2ea1b7c388163bc15d_th.jpg','url'=>'https://www.sohu.com/a/131266878_384578'],
                        ['title'=>'张梓琳','description'=>'张梓琳张梓琳','picur'=>'https://img.mp.itc.cn/upload/20170331/ce0423b0d39444c7a26a3f338cc6b4ec_th.jpg','url'=>'https://www.sohu.com/a/131266878_384578'],
                        ['title'=>'刘亦菲','description'=>'刘亦菲刘亦菲','picur'=>'https://img.mp.itc.cn/upload/20170331/f924af1bb89748f7afcc4b5c1e8af52b_th.jpg','url'=>'https://www.sohu.com/a/131266878_384578'],
                    ];
                    foreach ($girls as $girl){
                        $news[] = new News([
                            'title'       => $girl['title'],
                            'description' => $girl['description'],
                            'url'         => $girl['url'],
                            'image'       => $girl['picur'],
                        ]);
                    }
                    return $news;
                    break;
                case '解除绑定':
                    $user = User::get(['open_id'=>$message->FromUserName]);
                    if ($user===null){
                        //未绑定
                        return '还未绑定';
                    }else{
                        $user->open_id='';
                        if ($user->save()) {
                            return '成功解除绑定';
                        }

                    }
                case '订单':
                    $app = new Application(config('weixin'));
                    $notice = $app->notice;
                    $userId = $message->FromUserName;
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
                case '帮助':
                    $text = new Text();
                    return $text->content = "诱惑热线：18889996660 \n 热销中...";
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

    //微信回调方法
    public function call(){

        $app = new Application(config('weixin'));
        $oauth = $app->oauth;

        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        session('wechat_user',$user->toArray());
        $targetUrl = empty(session('target_url')) ? '/' : session('target_url');
        return $this->redirect($targetUrl);
        //header('location:'. $targetUrl); // 跳转到 user/profile
    }

    public function goods(){
        $goods =Db::name('goods')->alias('a')
            ->join('goods_intro b','a.id=b.goods_id')
            ->limit('5')
            ->order('a.id desc')->select();
        dump($goods);

    }
    //获得微信菜单
    public function getMenu(){
        $app = new Application(config('weixin'));
        $menu = $app->menu;
        dump($menu);
    }

    //设置微信菜单
    public function setMenu(){
        $app = new Application(config('weixin'));
        $menu = $app->menu;
        $buttons = [
            [
                "type" => "click",
                "name" => "热卖商品",
                "key"  => "hotGoods"
            ],
            [
                "name"       => "个人中心",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "我的订单",
                        "url"  => "http://weixin.hou1103.cn/wx/user/orders"
                    ],
                    [
                        "type" => "view",
                        "name" => "我的信息",
                        "url"  => "http://weixin.hou1103.cn/wx/user/index"
                    ],
                    [
                        "type" => "view",
                        "name" => "绑定账号",
                        "url" => "http://weixin.hou1103.cn/wx/user/bind"
                    ],
                ],
            ],
        ];
        $menu->add($buttons);
    }

}
