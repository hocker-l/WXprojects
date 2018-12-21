<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/25
 * Time: 21:41
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden=['topic_img_id','update_time'];
    public function img(){
        return $this ->belongsTo("Image","topic_img_id","id");
    }

}