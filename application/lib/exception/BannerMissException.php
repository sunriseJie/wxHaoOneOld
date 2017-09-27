<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/7/15
 * Time: 14:58
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{

    public $code = 404;
    public $msg = 'bannder未找到';
    public $errorCode = 40001;

}