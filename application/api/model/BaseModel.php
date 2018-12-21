<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/15
 * Time: 11:01
 */

namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    public function prefixImgUrl($value,$date){
        $finalUrl = $value;
        if($date['from'] == 1){
            $finalUrl = config("setting.img_prefix").$value;
        }else{

        }
        return $finalUrl;
    }

}