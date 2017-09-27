<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/8/12
 * Time: 21:39
 */

namespace app\api\validate;


class AddressValidate extends BaseValidate
{
    protected $rule = [
        'name' => 'require|isNotEmpty',
        'mobile' => 'require|isMobile',
        'province' => 'require|isNotEmpty',
        'city' => 'require|isNotEmpty',
        'country' => 'require|isNotEmpty',
        'detail' => 'require|isNotEmpty',


    ];
}