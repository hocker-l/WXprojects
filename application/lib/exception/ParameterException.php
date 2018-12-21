<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/8
 * Time: 16:45
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code =400;
    public $msg = "参数错误";
    public $errorCode =10000;

}