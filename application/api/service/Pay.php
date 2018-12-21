<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/11/19
 * Time: 10:21
 */

namespace app\api\service;


use app\lib\enum\OrderStatusEnum;
use app\lib\exception\TokenException;
use think\Exception;
use app\api\model\Order as orderModel;
use app\lib\exception\OrderException;
use think\Loader;
use think\Log;

Loader::import("WxPay.WxPay",EXTEND_PATH,".Api.php");
class Pay
{
    private $orderID;
    private $orderNo;
    function __construct($orderID)
    {
        if(!$orderID){
            throw new Exception("订单号不能为空！！");
        }
        $this->orderID=$orderID;
    }
    public function pay(){
        $this->checkOrderValid();
        $order =new order();
        $status=$order->checkOrderStock($this->orderID);
        if(!$status["pass"]){
            return $status;
        }
        return $this->makeWxPreOrder($status['orderPrice']);

    }
    public function makeWxPreOrder($totalPrice){
        $openid =Token::getCurrentTokenVar("openid");
        if(!$openid){
            throw new TokenException();
        }
        $wxOrderData = new \WxPayUnifiedOrder();
        $wxOrderData->SetOut_trade_no($this->orderNo);
        $wxOrderData->SetTrade_type("JSAPI");
        $wxOrderData->SetTotal_fee($totalPrice);
        $wxOrderData->SetBody("零售商贩");
        $wxOrderData->SetAppid($openid);
        $wxOrderData->SetNotify_url("");
        return $this->getPaySignature($wxOrderData);
    }
    private function getPaySignature($wxOrderData){
        $wxOrder = \WxPayApi::unifiedOrder($wxOrderData);
        if($wxOrder["return_code"]!="SUCCESS"||$wxOrder["result_code"]!="SUCCESS"){
            Log::record($wxOrder,"error");
            Log::record("获取预支付订单失败","error");
        }
        $this->recordPreOrder($wxOrder);
        $signatrue = $this->sign($wxOrder);
        return $signatrue;
    }
    private function  sign($wxOrder){
        $jsApiPayData = new \WxPayJsApiPay();
        $jsApiPayData->SetAppid(config("wx.app_id"));
        $jsApiPayData->SetTimeStamp((string)time());
        $rand = md5(time().mt_rand(0,1000));
        $jsApiPayData->SetNonceStr($rand);
        $jsApiPayData->SetPackage("prepay_id=".$wxOrder['prepay_id']);
        $jsApiPayData->SetSignType("md5");
        $sign = $jsApiPayData->MakeSign();
        $rawValues = $jsApiPayData->GetValues();
        $rawValues['paySign'] = $sign;
        unset($rawValues['appId']);
        return $rawValues;
    }
    private function recordPreOrder($wxOrder){
        orderModel::where("id","=",$this->orderID)
            ->update(['prepay_id' => $wxOrder['prepay_id']]);
    }
    public  function checkOrderValid(){
        $order = orderModel::where("id","=",$this->orderID)->find();
        if(!$order){
            throw  new OrderException();
        }
        if(!Token::isValidOperate($order->user_id)){
            throw new TokenException([
                "msg" =>"订单和用户不匹配！",
                "errorCode" => "10003"
            ]);
        }
        if($order->status!=OrderStatusEnum::UNPAID){
            throw new OrderException([
                "code" => "400",
                "msg" => "订单已经支付过了！",
                "errorCode" => "80003"
            ]);
        }
        $this->orderNo=$order->order_no;
        return true;

    }


}