<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/26
 * Time: 10:06
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;


class Token
{
    public function getToken($code = ""){
        (new TokenGet())->goCheck();
        $ut = new UserToken($code);
        $token = $ut->get();
        $arr = [
            "token" =>$token
        ];
        return json_encode($arr);
    }


}