<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/11/27
 * Time: 16:45
 */

namespace app\api\service;

use app\api\model\Product;
use app\lib\enum\OrderStatusEnum;
use think\Db;
use think\Exception;
use think\Loader;
use \app\api\model\Order as orderModel;
use \app\api\service\Order as orderService;
use think\Log;

Loader::import("WxPay",EXTEND_PATH,"Api.php");
class WxNotify extends \WxPayNotify
{
    //    protected $data = <<<EOD
//<xml><appid><![CDATA[wxaaf1c852597e365b]]></appid>
//<bank_type><![CDATA[CFT]]></bank_type>
//<cash_fee><![CDATA[1]]></cash_fee>
//<fee_type><![CDATA[CNY]]></fee_type>
//<is_subscribe><![CDATA[N]]></is_subscribe>
//<mch_id><![CDATA[1392378802]]></mch_id>
//<nonce_str><![CDATA[k66j676kzd3tqq2sr3023ogeqrg4np9z]]></nonce_str>
//<openid><![CDATA[ojID50G-cjUsFMJ0PjgDXt9iqoOo]]></openid>
//<out_trade_no><![CDATA[A301089188132321]]></out_trade_no>
//<result_code><![CDATA[SUCCESS]]></result_code>
//<return_code><![CDATA[SUCCESS]]></return_code>
//<sign><![CDATA[944E2F9AF80204201177B91CEADD5AEC]]></sign>
//<time_end><![CDATA[20170301030852]]></time_end>
//<total_fee>1</total_fee>
//<trade_type><![CDATA[JSAPI]]></trade_type>
//<transaction_id><![CDATA[4004312001201703011727741547]]></transaction_id>
//</xml>
//EOD;
    public function NotifyProcess($objData, $config, &$msg)
    {
        if($objData["result_code"]=="SUCCESS"){
            $orderNo=$objData["out_trade_no"];
            Db::startTrans();
            try{
                $order=orderModel::where("order_no","=",$orderNo)->lock(true)
                    ->find();
                if($order->status==1){
                    $service = new orderService();
                    $status=$service->checkOrderStock($order->id);
                    if($status["pass"]){
                        $this->updateOrderStatus($order->id,true);
                        $this->reduceStock($status);
                    }else{
                        $this->updateOrderStatus($order->id,false);
                    }
                }
                Db::commit();
            }catch (Exception $exception){
                Db::rollback();
                Log::error($exception);
                return false;
            }
        }
        return true;
        
    }
    private function reduceStock($status){
        foreach ($status["pStatusArray"] as $singPStatus){
            Product::where("id","=",$singPStatus["id"])
                ->setDec("stock",$singPStatus["count"]);
        }
    }
    private function updateOrderStatus($orderID, $success){
        $status=$success?OrderStatusEnum::PAID:OrderStatusEnum::PAID_BUT_OUT_OF;
        orderModel::where("id","=",$orderID)->update(["status"=>$status]);
    }

}