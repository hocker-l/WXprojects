<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/2
 * Time: 15:32
 */

namespace app\api\validate;


use think\Validate;

class TestValidate extends Validate
{
    protected $rule=[
        "name"=>"require|max:10",
        "email"=>"email"
    ];
}