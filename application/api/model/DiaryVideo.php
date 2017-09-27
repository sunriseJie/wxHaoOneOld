<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/9/5
 * Time: 22:24
 */

namespace app\api\model;


class DiaryVideo extends BaseModel
{
    protected $hidden = ['delete_time','update_time',
        'id','video_id','diary_id'];

    public function video(){
        return $this -> hasOne('Video','id','video_id');
    }
}