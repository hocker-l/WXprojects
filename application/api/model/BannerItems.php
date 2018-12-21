<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/14
 * Time: 21:34
 */

namespace app\api\model;

class BannerItems extends BaseModel
{
    protected $hidden=['id','delete_time','update_time','img_id','banner_id'];
    protected $table = "banner_item";
    public function img(){
        return $this->belongsTo("Image","img_id","id");
    }

}