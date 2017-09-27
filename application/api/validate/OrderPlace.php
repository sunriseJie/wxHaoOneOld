<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/8/15
 * Time: 21:48
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;

class OrderPlace extends BaseValidate
{

    protected $rule = [
        'products' => 'require|isArrayProduct'
    ];

    protected $singleRule = [
        'product_id' => 'require|isPositiveInteger',
        'count' => 'require|isPositiveInteger'
    ];

    protected function isArrayProduct($values)
    {
        if (Empty($values)) {
            throw new ParameterException([
                'msg' => '参数为空',
                'errorCode' => 10003
            ]);
        }
        if (!is_array($values)) {
            throw new ParameterException([
                'msg' => '参数类型不合法',
                'errorCode' => 10004
            ]);
        }

        foreach ($values as $value) {
            $this->productValidate($value);
        }
        return true;
    }

    protected function productValidate($product)
    {
        $validate = new BaseValidate($this->singleRule);
        $result = $validate->check($product);
        if (!$result) {
            throw new ParameterException([
                'msg' => '参数不合法',
                'errorCode' => 10005
            ]);
        }
    }
}