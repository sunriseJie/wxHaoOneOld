<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/7/28
 * Time: 15:01
 */

namespace app\api\service;

use app\lib\enum\ScopeEnum;
use app\lib\exception\WxLoginException;
use think\Cache;
use app\api\model\User as userModel;
use think\Exception;

class UserToken extends Token
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('WeChat.wx_appID');
        $this->wxAppSecret = config('WeChat.wx_appSecret');
        $this->wxLoginUrl = sprintf(config('WeChat.wx_loginUrl'),
            $this->wxAppID, $this->wxAppSecret, $this->code);

    }

    public function get()
    {
        $wxRequest = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($wxRequest, true);
        $token = '';
        if (empty($wxResult)) {
            throw new Exception('获取session_key及openID时异常，跟微信登录服务器通讯失败');

        } else {
            $loginFail = array_key_exists('errcode', $wxResult);
            if ($loginFail) {
                $this->processLoginError($wxResult);
            } else {
                $token = $this->grantToken($wxResult);
            }
            return $token;
        }
    }

    private function grantToken($wxResult)
    {
        $openid = $wxResult['openid'];
        $user = userModel::getByOpenId($openid);
        if (!$user) {
            $user = $this->newUser($openid);
        }
        $uid = $user->id;

        $cachedValue = $this->prepareCacheValue($wxResult, $uid);

        $token = $this->saveToCache($cachedValue);

        return $token;
    }

    private function saveToCache($cachedValue)
    {
        $key = self::generateToken();
        $value = json_encode($cachedValue);
        $exprie_in = config('setting.token_expire_in');

        $request = cache($key, $value, $exprie_in);

        if (!$request) {
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 60003,
            ]);
        }
        return $key;
    }

    private function prepareCacheValue($wxResult, $uid)
    {
        $cachedValue = $wxResult;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = ScopeEnum::User;
        return $cachedValue;
    }

    private function newUser($openid)
    {
        $user = userModel::create([
            'openid' => $openid
        ]);
        return $user;
    }

    private function processLoginError($wxResult)
    {

        $msg = [
            'wx_errorCode' => $wxResult['errcode'],
            'wx_errorMsg' => $wxResult['errmsg']
        ];
        throw new WxLoginException([
            'msg' => $msg,
        ]);

    }

//    private function getCache($code)
//    {
//        //TODO:读取app_debug值判断，缓存只在生产模式下工作
//        $this->iniCache();
//        return Cache::get($code);
//    }
//
//    private function iniCache()
//    {
//        $cacheOptions = [
//            'type' => 'File',
//            'expire' => '3600',
//            'prefix' => 'token',
//            'path' => CACHE_PATH
//        ];
//        Cache::connect($cacheOptions);
//
//    }
}