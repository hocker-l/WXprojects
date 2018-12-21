<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/15
 * Time: 11:20
 */

namespace app\api\controller\v1;

use app\api\validate\IdCollection;
use app\api\model\Theme as themeModel;
use app\api\validate\IdValidate;
use app\lib\exception\ThemeException;
use think\Controller;

class Theme extends Controller
{
    public function theme($ids){
        (new IdCollection())->goCheck();
        $ids = explode(',',$ids);
        $result=themeModel::with('topicImg,headImg')
            ->select($ids);
        if($result->isEmpty()){
            throw new ThemeException();
        }
        return json($result);

    }
public function getComplexOne($id){
    (new IdValidate())->goCheck();
    $theme = themeModel::getThemeWithProduct($id);
    if($theme->isEmpty()){
        throw new ThemeException();
    }
    return json($theme);
}
}