<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/8/14
 * Time: 22:39
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 404;
    public $msg = '用户不存在';
    public $errorCode = 60001;
}