<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/8/16
 * Time: 23:36
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = '400';
    public $msg = '订单不存在，或已删除';
    public $errorCode = '80001';
}