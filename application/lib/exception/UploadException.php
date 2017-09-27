<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/9/11
 * Time: 14:57
 */

namespace app\lib\exception;


class UploadException extends BaseException
{
    public $code = 400;
    public $msg = '上传失败!';
    public $errorCode = 70001;
}