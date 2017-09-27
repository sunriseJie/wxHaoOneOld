<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/8/12
 * Time: 23:12
 */

namespace app\api\service;


use think\Exception;
use app\api\model\User as UserModel;

class User
{
    public static function hasCurrentUID($uid = '')
    {
        if (!isEmpty($uid)) {
            $user = UserModel::getByUID($uid);
            if($user){
                return true;
            }else{
                return false;
            }
        }else{
            throw new Exception('尝试把空的uid去查询数据库');
            return false;

        }
    }
}