<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/8
 * Time: 14:54
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{
    public $code =404;
    public $msg = "请求的Banner不存在！";
    public $errorCode =40000;

}