<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/8/12
 * Time: 22:45
 */

namespace app\api\validate;


class CodeValidate extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty',
    ];
}