<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/8/8
 * Time: 21:40
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 400;
    public $msg = '服务器缓存异常';
    public $errorCode = 60003;
}