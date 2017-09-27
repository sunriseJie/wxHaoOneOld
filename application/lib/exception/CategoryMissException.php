<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/7/27
 * Time: 22:20
 */

namespace app\lib\exception;


class CategoryMissException extends BaseException
{

    public $code = 400;
    public $msg = '没有分类';
    public $errorCode = 50001;

}