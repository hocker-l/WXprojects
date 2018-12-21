<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/2
 * Time: 16:10
 */

namespace app\api\validate;
use function PHPSTORM_META\type;
use think\Validate;
class IdValidate extends BaseValidate
{
    protected $rule=[
        "id"=>"require|isPositiveInteger"
    ];
}