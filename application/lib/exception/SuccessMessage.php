<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/8/14
 * Time: 22:52
 */

namespace app\lib\exception;


class SuccessMessage extends BaseException
{
    public $code = '201';
    public $msg = '更新成功';
    public $errorCode = '70001';
}