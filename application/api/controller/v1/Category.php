<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/25
 * Time: 21:39
 */

namespace app\api\controller\v1;

use app\lib\exception\CategoryException;
use app\api\model\Category as CategoryModel;


class Category
{
    public function getAllCategory(){
        $categorys = CategoryModel::all([],"img");
        if($categorys->isEmpty()){
            throw  new CategoryException();
        }else{

        }
        return $categorys;
    }

}