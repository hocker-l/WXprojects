<?php
/**
 * Created by PhpStorm.
 * User: lsp
 * Date: 2018/7/8
 * Time: 14:48
 */

namespace app\lib\exception;



use Exception;
use think\exception\Handle;
use think\Request;

class ExceptionHandler extends Handle
{

    private $code;
    private $msg;
    private $errorCode;
    public function render(Exception $e)
    {
        if($e instanceof BaseException){
            $this->code=$e->code;
            $this->msg=$e->msg;
            $this->errorCode=$e->errorCode;
        }else{
            if(config("app_debug")){
                return parent::render($e);
            }else{
                $this->code=500;
                $this->msg="服务器内部错误，不想告诉你";
                $this->errorCode=999;
                $this->recodeErrorLog($e);
            }
        }
        $request= Request::instance();
        $result= [
          "msg"=>$this->msg,
          "error_code"=>$this->errorCode,
          "request_url"=>$request->url()
        ];
        return json($result,$this->code);
    }
    public function recodeErrorLog(Exception $exception){
        Log::init([
            'type'  =>  'File',
            'path'  =>  LOG_PATH,
            'level' => []
        ]);
        Log::log($exception->getMessage(),"error");
    }

}