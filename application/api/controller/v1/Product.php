<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/24
 * Time: 22:41
 */

namespace app\api\controller\v1;


use app\api\model\BaseModel;
use app\api\validate\Count;
use app\api\model\Product as productModel;
use app\api\validate\IdValidate;
use app\lib\exception\ProductException;

class Product
{
    public function  getRecent($count = 15){
        (new Count())->goCheck();
        $products = productModel::getMostRecent($count);
        if($products->isEmpty()){
            throw  new ProductException();
        }else{

        }
        return json($products);
    }
    public function getAllInCategory($id){
//        (new IdValidate()) ->goCheck();
        $products = productModel::getProductsByCategoryId($id);
        if($products ->isEmpty()){
            throw  new ProductException();
        }else{

        }
        return $products;

    }
    public  function  getOne($id){
        (new IdValidate())->goCheck();
        $product = productModel::getProductsDetail($id);
        if($product ->isEmpty()){
            throw  new ProductException();
        }else{

        }
        return $product;
    }
    


}