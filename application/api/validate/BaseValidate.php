<?php

namespace app\api\validate;

use app\lib\exception\ParameterException;
use think\Validate;
use think\Request;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        $request = Request::instance();
        $params = $request->param();

        $result = $this->batch()->check($params);

        if (!$result) {
            $err = ['msg' => $this->error];
            throw  new ParameterException($err);
        } else {
            return true;
        }
    }

    protected function isPositiveInteger($value, $rule = '', $data = '', $field = '')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return false;
        }


    }

    /**
     * 验证手机号是否正确
     * @author honfei
     * @param number $mobile
     */
    protected function isMobile($mobile)
    {
        if (!is_numeric($mobile)) {
            return false;
        }
        return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
    }


    protected function idsAllMustInteger($value = '')
    {
        if (empty($value)) {
            return false;
        }
        $values = explode(',', $value);
        if (empty($values)) {
            return false;
        }
        foreach ($values as $id) {
            if (self::isPositiveInteger($id)) {
                return true;
            } else {
                return false;
            }
        }
    }

    protected function isNotEmpty($value)
    {
        if (empty($value)) {
            return false;
        } else {
            return true;
        }
    }

    public function getDataByRule($arrayParams)
    {
        if (array_key_exists('user_id', $arrayParams) |
            array_key_exists('uid', $arrayParams)
        ) {
            throw new ParameterException([
                'msg' => '参数中包含有非法的字段user_id & uid'
            ]);
        }

        $newArray = [];
        foreach ($this->rule as $key => $value) {
            $newArray[$key] = $arrayParams[$key];
        }
        return $newArray;

    }
}