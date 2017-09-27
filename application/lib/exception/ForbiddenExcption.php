<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/8/15
 * Time: 15:11
 */

namespace app\lib\exception;


class ForbiddenExcption extends BaseException
{
    public $code = '403';
    public $msg = '没有操作权限';
    public $errorCode = '10001';
}