<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/29
 * Time: 11:25
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code =401;
    public $msg = "Token已过期或Token无效！";
    public $errorCode =10001;

}