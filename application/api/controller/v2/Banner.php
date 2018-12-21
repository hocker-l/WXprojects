<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/2
 * Time: 14:58
 */
namespace app\api\controller\v2;

use app\api\validate\IdValidate;
use app\api\model\Banner as modelBanner;
use app\lib\exception\BannerMissException;
class Banner
{
    public function banner($id){
        (new IdValidate())->goCheck();
             $banner=modelBanner::getBannerById($id);
             if(!$banner){
                 throw  new BannerMissException();
             }else{

             }
            return "这个是V2的接口！！";

         }


    }

