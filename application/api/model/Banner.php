<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/8
 * Time: 10:19
 */

namespace app\api\model;

class Banner extends BaseModel
{
   protected $hidden=['delete_time','update_time'];
   public function items(){
       return $this->hasMany("BannerItems","banner_id","id");
   }
   public static function getBannerById($id){
       $banner = self::with(['items','items.img'])->select($id);
       return $banner;
   }

}