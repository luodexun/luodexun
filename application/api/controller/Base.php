<?php

namespace app\api\controller;
class Base {

    protected $code = 0;
    protected $_retValue = 0;
    protected $_retMsg = "";  //返回消息
    protected $_data =array();
    public function __construct() {

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