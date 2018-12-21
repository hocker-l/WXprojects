<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/29
 * Time: 10:12
 */

namespace app\api\service;

use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

class Token
{
    public static function generateToken(){
        $randomChars = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $tokenSalt = config("secure.token_salt");
        return md5($randomChars.$timestamp.$tokenSalt);

    }
    public  static function  getCurrentTokenVar($key){
        $token = Request::instance()
            ->post("token");
        $vars = Cache::get($token);
        if(!$vars){
            throw  new TokenException();
        }else{
            if(!is_array($vars))
            {
                $vars = json_decode($vars, true);
            }
            if (array_key_exists($key, $vars)) {
                return $vars[$key];
            }
            else{
                throw new Exception('尝试获取的Token变量并不存在');
            }

        }
    }
    public  static  function  getCurrentUid(){
        $uid =self::getCurrentTokenVar("uid");
        return $uid;

    }
    //验证token是否合法或者是否过期
    //验证器验证只是token验证的一种方式
    //另外一种方式是使用行为拦截token，根本不让非法token
    //进入控制器
    public static function needPrimaryScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope) {
            if ($scope >= ScopeEnum::User) {
                return true;
            }
            else{
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }
    // 用户专有权限
    public static function needExclusiveScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope){
            if ($scope == ScopeEnum::User) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }
    public static function isValidOperate($checkedUID){
        if(!$checkedUID){
            throw new Exception("检查UID时必须传入一个被检查的UID");
        }
        $currentOperateUID =self::getCurrentUid();
        if($currentOperateUID ==$checkedUID){
            return true;
        }
        return false;

    }


}