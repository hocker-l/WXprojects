<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/26
 * Time: 15:31
 */

namespace app\lib\exception;


class WeChatException extends BaseException
{
    public $code =400;
    public $msg = "微信服务器接口调用失败";
    public $errorCode =999;

}