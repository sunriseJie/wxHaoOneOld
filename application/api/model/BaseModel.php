<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/7/25
 * Time: 21:57
 */

namespace app\api\model;


use think\Model;

class BaseModel extends Model
{
    //读取器接受另个参数第一个为读取器定义的url字段，第二个参数返回整条数据
    protected function prefixImgUrl($value, $data)
    {
        $finalUrl = $value;
        if ($data['from'] == 1) {
            return config('setting.img_prefix') .$finalUrl;
        } else {
            return $finalUrl;
        }

    }

    protected function prefixVideoCoverImage($value, $data)
    {
        $finalUrl = $value;
        if ($data['from'] == 1) {
            return config('setting.img_prefix') .$finalUrl;
        } else {
            return $finalUrl;
        }

    }

    protected function prefixVideoUrl($value, $data)
    {
        $finalUrl = $value;
        if ($data['from'] == 1) {
            return config('setting.video_prefix') .$finalUrl;
        } else {
            return $finalUrl;
        }

    }
}