<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/7/28
 * Time: 14:56
 */

namespace app\api\validate;

use app\lib\exception\ParameterException;
use think\Validate;
use think\Request;

class TokenValidate extends BaseValidate
{
    protected $rule = [
        'token' => 'require|length:32',
    ];

    public function goCheck()
    {
        $request = Request::instance();
        $params = $request->header();

        $result = $this->batch()->check($params);

        if (!$result) {
            $err = ['msg' => $this->error];
            throw  new ParameterException($err);
        } else {
            return true;
        }
    }
}