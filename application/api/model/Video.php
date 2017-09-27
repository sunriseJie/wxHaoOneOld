<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/9/5
 * Time: 22:27
 */

namespace app\api\model;


class Video extends BaseModel
{
    protected $hidden = ['delete_time', 'update_time',
        'form'];

    public function getCoverImageAttr($value,$data){
        return $this -> prefixVideoCoverImage($value,$data);
    }

    public function getUrlAttr($value,$data){
        return $this -> prefixVideoUrl($value,$data);
    }
}