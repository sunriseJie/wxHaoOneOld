<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/7/28
 * Time: 15:03
 */

namespace app\lib\exception;


class TokenMissException extends BaseException
{
    public $code = 400;
    public $msg = '获取token失败';
    public $errorCode = 60001;
}