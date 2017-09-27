<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/9/10
 * Time: 22:12
 */

namespace app\api\controller\v1;

use app\lib\exception\UploadException;
use think\Request;
use think\Response;

class Upload
{

    protected $savePath = ROOT_PATH . '/public' . '/uploads';
    public function uploadImagesAndVideos(){

//       建立权限验证
        $fileType = input('post.fileType');
        if(!$fileType){
            throw new UploadException([
                'msg' => 'fileType参数缺失'
            ]);
        }
        if($fileType == 'image'){
            $file = request()->file('image');
            $resule = $this ->saveImage($file);
            return json($resule);

        }

        if($fileType == 'video'){
            $file = request()->file('video');
            $resule = $this ->saveVideo($file);
            return $resule;
        }


    }

    public function saveImage($file){
        ob_end_clean();
        $info = null;
        if($file){
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move($this->savePath.'/images');
        }

        if($info){
            $msg = [
                'fileType' => $info->getExtension(),
                'from' => 1,
                'path' => config('setting.uploads_path').'images/' . $info->getSaveName()
            ];

//            $msg = config('setting.uploads_path').'images/' . $info->getSaveName();

//            写进数据库
            return $msg;

        }else{
            // 上传失败获取错误信息
            $msg = $file->getError();
            throw new UploadException([
                'msg' => $msg,

            ]);
        }
    }

    public function saveVideo($file){
        $info = null;
        if($file){
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move($this->savePath.'/video');
        }

        if($info){
            $msg = [
                'fileType'  => $info->getExtension(),
                'path' =>config('setting.uploads_path').'video/' . $info->getSaveName(),
                'from' =>1
            ];


//            写进数据库
            return json($msg);

        }else{
            // 上传失败获取错误信息
            $msg = $file->getError();
            throw new UploadException([
                'msg' => $msg,

            ]);
        }
    }
}