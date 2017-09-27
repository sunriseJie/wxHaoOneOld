<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/7/26
 * Time: 21:43
 */

namespace app\lib\exception;


class ThemeMissException extends BaseException
{
    public $code = 404;
    public $msg = 'Theme未找到';
    public $errorCode = 20001;
}