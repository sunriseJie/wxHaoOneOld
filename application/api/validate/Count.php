<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/7/27
 * Time: 14:45
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,15',
    ];
}