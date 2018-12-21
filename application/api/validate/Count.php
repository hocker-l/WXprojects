<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/24
 * Time: 22:44
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
      "count" => "isPositiveInteger|between:1,15"
    ];

}