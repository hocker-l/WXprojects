<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/8/12
 * Time: 15:18
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
    protected $hidden = ['delete_time','img_id','product_id'];
    public function imgUrl(){
       return $this ->belongsTo("image","img_id","id");
    }

}