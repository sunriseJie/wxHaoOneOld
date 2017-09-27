<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/7/27
 * Time: 14:57
 */

namespace app\lib\exception;


class ProductMissException extends BaseException
{
    public $code = '400';
    public $msg = 'Product未找到';
    public $errorCode = '30001';
}