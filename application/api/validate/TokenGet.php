<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/26
 * Time: 10:09
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule =[
      "code" => "require|isNotEmpty"
    ];
    protected $message=[
        'code' => '没有code还想拿token？做梦哦'
    ];

}