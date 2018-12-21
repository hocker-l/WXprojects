<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/15
 * Time: 11:22
 */

namespace app\api\model;


class Theme extends BaseModel
{
    protected $hidden=['delete_time','update_time','topic_img_id','head_img_id'];
    public function topicImg(){
        return $this->belongsTo("Image","topic_img_id","id");
    }
    public function headImg(){
        return $this->belongsTo("Image","head_img_id","id");
    }
    public function products(){
        return $this->belongsToMany("Product","Theme_Product","product_id","theme_id");
    }
    public static function getThemeWithProduct($id){
        $theme = self::with(["products","headImg","topicImg","products.getImg"])
            ->select($id);
        return $theme;
    }

}