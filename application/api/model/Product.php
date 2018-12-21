<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/15
 * Time: 11:21
 */

namespace app\api\model;


class Product extends BaseModel
{
    protected $table ='product';
    protected $hidden = ['delete_time','update_time','create_time','pivot'];
    public function getImg(){
        return $this->belongsTo("Image","img_id","id");
    }
    public static function getMostRecent($count){
        $products = self::with("getImg")->
        limit($count)
            ->order('create_time desc')
            ->select();
        return $products;
//        $products = self::limit($count)
//            ->order('create_time desc')
//            ->select();
//        return $products;
    }
    public  function imgs(){
         return  $this ->hasMany("product_image","product_id","id");
    }
    public  function properties(){
        return   $this ->hasMany("product_property","product_id","id");
    }
    public static function getProductsByCategoryId($category_id){
        $products = self::with("getImg")->where("category_id","=",$category_id)
            ->select();
        return $products;
    }
    public static function getProductsDetail($id){
        $product = self::with( [
            'imgs' => function ($query)
            {
                $query->with(['imgUrl'])
                    ->order('order', 'asc');
            }])
            ->with("getImg")
            ->with("properties")
            ->select($id);
        return $product;
    }

}