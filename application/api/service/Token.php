<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/8/8
 * Time: 21:03
 */

namespace app\api\service;


use app\api\validate\TokenValidate;
use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;
use think\Response;

class Token
{
    public static function generateToken()
    {
        $randChars = comGetRandChar(32);
        $timeStamp = $_SERVER['REQUEST_TIME'];
        $salt = config('secure.token_salt');

        return md5($randChars . $timeStamp . $salt);
    }

    public static function getCurrentTokenVar($key)
    {
        $token = Request::instance()
            ->header('token');
        $vars = Cache::get($token);
        if (!$vars) {
            throw new TokenException(['msg' => 'token无效或已经过期']);
        } else {
            if (!is_array($vars)) {
                $vars = json_decode($vars, true);
            }
            if (array_key_exists($key, $vars)) {
                return $vars[$key];
            } else {
                throw new Exception('尝试获取token的变量不存在，错误的key');
            }
        }


    }

    public static function getCurrentUID()
    {
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }


}