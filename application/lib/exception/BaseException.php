<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/7/15
 * Time: 14:56
 */

namespace app\lib\exception;


use think\Exception;

class BaseException extends Exception
{
//  HTTP状态码 404,200
    public $code = 400;
//  错误的具体消息
    public $msg = '参数错误';
//  自定义的错误消息
    public $errorCode = 10000;

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