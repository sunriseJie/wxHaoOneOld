<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/9/2
 * Time: 16:53
 */

namespace app\api\model;


class DiaryImage extends BaseModel
{
    protected $hidden = ['delete_time','update_time','id','img_id','diary_id'];
    public function photo(){
        return $this -> hasOne('Image','id','img_id');
    }
}