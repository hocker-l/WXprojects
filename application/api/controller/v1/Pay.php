<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/11/19
 * Time: 10:03
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\WxNotify;
use app\api\validate\IdValidate;
use app\api\service\Pay as payService;

class Pay extends BaseController
{
    protected $beforeActionList =["checkExclusiveScope"=>["only"=>"getPreOrder"]];
    public function getPreOrder($id=""){
        (new IdValidate())->goCheck();
        $pay=new payService($id);
        return $pay->pay();
    }
    public function notifyConcurrency()
    {
        $notify = new WxNotify();
        $notify->handle();
    }
    public function receiveNotify(){
        $wxNofify=new WxNotify();
        $wxNofify->Handle();
    }

}