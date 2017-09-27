<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/7/29
 * Time: 16:30
 */

namespace app\lib\exception;


use Throwable;

class WxLoginException extends BaseException
{
    public $code = 400;
    public $msg = '微信内部错误';
    public $errorCode = '60002';


    public function __construct($params = [])
    {
        if (!is_array($params)) {
            return;
        }

        if (array_key_exists('code', $params)) {
            $this->code = $params['code'];
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
        if (array_key_exists('errorCode', $params)) {
            $this->errorCode = $params['errorCode'];
        }
    }
}