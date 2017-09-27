<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/9/1
 * Time: 15:25
 */

namespace app\api\validate;


class DiaryValidate extends BaseValidate
{
    protected $rule = [
        'showDetail' => 'boolean',
        'count' => 'number',
        'start' => 'number',
    ];

    protected $message = [
        'showDetail' => 'true or false',
        'count' =>'必须为数字',
        'start' =>'必须为数字'
    ];
}