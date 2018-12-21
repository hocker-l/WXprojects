<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/2
 * Time: 14:58
 */

namespace app\api\controller\v1;


use app\api\validate\IdValidate;
use app\api\model\Banner as modelBanner;
use app\lib\exception\BannerMissException;
use think\Exception;

class Banner
{
    public function banner($id)
    {
        (new IdValidate())->goCheck();
        $banner = modelBanner::getBannerById($id);
        if ($banner->isEmpty()) {
            throw  new BannerMissException();
        } else {
            return json($banner);

        }
    }

}