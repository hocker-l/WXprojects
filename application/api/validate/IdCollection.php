<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/15
 * Time: 14:14
 */

namespace app\api\validate;


class IdCollection extends BaseValidate
{
    protected $rule=[
        "ids"=>"require|checkIds"
    ];
    protected $message =[
        'ids' => "ids参数必须是以逗号隔开的正整数！"
    ];
    protected function checkIds($value){
        $value = explode(",",$value);
        if(empty($value)){
            return false;
        }
        foreach ($value as $id){
            if(!$this->isPositiveInteger($id)){
                return false;
            }
        }
        return true;
    }

}