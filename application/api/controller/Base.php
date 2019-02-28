<?php

namespace app\api\controller;
class Base {
    use Send;
    protected $code = 0;
    protected $_retValue = 0;
    protected $_retMsg = "";  //返回消息
    protected $_data =array();
    public function __construct() {
        dump(intval(time()));dump(intval(session('time')));dump(intval(time())-intval(session('time'))>30);exit();
         if(intval(time())-intval(session('time'))>30){
             self::returnMsg(401,'请求时间戳与服务器时间戳异常，请调整本地时间！');
         }
         $sign=md5(http_build_query(['app_id'=>session('app_id'),'time'=>session('time'),'key'=>'a23eca5074b2a12d7d37a55e3add898a']));
         if(session('sign')!==$sign){
             self::returnMsg(401,'签名验证错误！！！请检查签名的合法性。');
         }
    }
    /**
     * 获取返回代码
     *
     * @return int
     */
    public function getRetValue() {
        return $this->_retValue;
    }

    /**
     * 获取返回消息
     *
     * @return string
     */
    public function getRetMsg() {
        return $this->_retMsg;
    }

    /**
     * 获取返回数据
     *
     * @return array
     */
    public function getData() {
        return $this->_data;
    }

    /**
     * 设置返回代码
     *
     * @param $code
     * @return $this
     */
    public function setCode($code) {
        $this->_retValue = $code;
        return $this;
    }

    /**
     * 设置返回消息
     *
     * @param $_retMsg
     * @return $this
     */
    public function setMsg($_retMsg) {
        $this->_retMsg = $_retMsg;
        return $this;
    }

    /**
     * 设置返回数据
     *
     * @param $_data
     * @return $this
     */
    public function setData($_data) {
        $this->_data = $_data;
        return $this;
    }

    public function renderOutput() {
        return json([
            "returnCode"  => $this->_retValue,
            "returnMsg"    => $this->_retMsg,
            "returnData"   => $this->_data,
            "systemtime"   => time()
        ]);
    }
}

?>