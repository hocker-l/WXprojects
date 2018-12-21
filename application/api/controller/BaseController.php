<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/9/16
 * Time: 14:58
 */

namespace app\api\controller;


use app\api\service\Token;
use think\Controller;

class BaseController extends Controller
{

    protected function checkExclusiveScope()
    {
        Token::needExclusiveScope();
    }

    protected function checkPrimaryScope()
    {
        Token::needPrimaryScope();
    }

}