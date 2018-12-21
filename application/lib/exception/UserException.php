<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/9/14
 * Time: 10:46
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code =404;
    public $msg = "用户不存在！";
    public $errorCode =60000;
}