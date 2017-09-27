<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/7/26
 * Time: 11:54
 */

namespace app\api\validate;



class IDCollectionMustBeInt extends BaseValidate
{
    protected $rule=[
        'ids' => 'require|idsAllMustInteger',
    ];

    protected $message = [
        'ids' => 'ids必须是以逗号分隔的多个正整数'
    ];

}