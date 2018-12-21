<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/14
 * Time: 22:25
 */

namespace app\api\model;

class Image extends  BaseModel
{
    protected $hidden=['id','delete_time','update_time','from'];
    protected $table = "Image";
    public function getUrlAttr($value,$date){
        return $this->prefixImgUrl($value,$date);
    }

}