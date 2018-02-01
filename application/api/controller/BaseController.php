<?php

namespace app\api\controller;

use think\Controller;

class BaseController extends Controller
{
    //

    public function _initialize()
    {


        parent::_initialize();
    }


    public function getJson( $msg,$success = false,$data=null)
    {

        return json([
            "success" => $success,
            "msg" =>$msg,
            "result" => $data
        ]);

    }
}
