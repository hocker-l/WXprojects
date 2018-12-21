<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/8/12
 * Time: 15:19
 */

namespace app\api\model;


class ProductProperty extends  BaseModel
{
    protected $hidden = ['delete_time','img_id','product_id'];

}