<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/9/2
 * Time: 16:48
 */

namespace app\api\model;


class Diary extends BaseModel
{
    protected $hidden = ['delete_time', 'update_time', 'type', 'cover_image_id'];

    public function photos()
    {
        return $this->hasMany('DiaryImage', 'diary_id', 'id');
    }

//    public function coverImg()
//    {
//        return $this->hasOne('Image', 'id', 'cover_image_id');
//    }

    public function videos()
    {
        return $this->hasMany('DiaryVideo', 'diary_id', 'id');
    }

    public static function getAllData()
    {
        return self::with(['photos', 'photos.photo', 'videos.video'])
            ->order('month asc')
            ->select();

    }


}