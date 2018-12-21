<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/26
 * Time: 10:18
 */

namespace app\api\model;


class User extends BaseModel
{
    public  function  address(){
        return $this->hasOne("UserAddress","user_id","id");
    }
    public static function  getByOpenID($openid){
        $user = self::where("open_id","=",$openid)
            ->find();
        return $user;
    }
}