<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/9/1
 * Time: 14:52
 */

namespace app\api\controller\v1;


use app\api\model\DiaryImage;
use app\api\model\DiaryVideo;
use app\api\model\Image;
use app\api\model\Video;
use app\api\validate\DiaryValidate;
use app\api\model\Diary as DiaryModel;

class Diary
{
    protected $showDetail = false;

    public function getDiary($showDetail = false, $count = 15, $start = 0)
    {
        $this->showDetail = $showDetail;
        $data = DiaryModel::getAllData();
        $data = $this->formatDiary($data);
        return $data;
    }


    private function formatDiary($data)
    {
        $diaryData = [];
        foreach ($data as $diary){
            $diaryPhoto =[];
            foreach ($diary['photos'] as $p){
                array_push($diaryPhoto,$p['photo']['url']);
            }
            $diary['photo'] = $diaryPhoto;
            $diary['photos'] = [];
//            $diary['cover_image_w640'] = $diary['cover_img']['url'];
            $diary['cover_image_w640'] = $diary['cover_image'];
//            $diary['cover_img'] = [];
            $diaryContainer['showDetail'] = $this->showDetail;
            $diaryContainer['type'] = 4;
            $diaryContainer['data'] = $diary;
            array_push($diaryData,$diaryContainer);
        }
        return $diaryData;
    }

    public function createDiary(){
        $data = input('post.');
        $diary['name'] = $data['name'];
        $diary['content'] = $data['content'];
        $diary['month'] = $data['month'];
        $diary['cover_image'] = $data['cover_img'];
        $diary['photos'] = [];
        $diary['videos'] = [];

        $_diaryModel = new DiaryModel();
        $_diaryModel-> data($diary);
        $_diaryModel->allowField(true)->save();
        $newDiary_id = $_diaryModel->id;
        $cover_img_id = 0;

        if($data['photos']){
            foreach ($data['photos'] as $item){
                $imageModel = new Image();
                $imageModel->data([
                    'url' => $item['path'],
                    'from' => 2
                ]);
                $imageModel->save();
                $image_id = $imageModel->id;

                if($cover_img_id == 0 ){$cover_img_id = $image_id;}

                $diaryImageModel = new DiaryImage();
                $diaryImageModel->data([
                    'img_id' => $image_id,
                    'diary_id' => $newDiary_id
                ]);
                $diaryImageModel->save();
            }

        }

        if($data['videos']){
            foreach ($data['videos'] as $item){
               $videoModel = new Video();
               $diaryVideoModel = new DiaryVideo();
               $videoModel ->data([
                   'url' => $item['path'],
                   'from' => 2
               ]);
               $videoModel->save();
               $video_id = $videoModel->id;
               $diaryVideoModel ->data([
                   'video_id' => $video_id,
                   'diary_id'=> $newDiary_id
               ]);
               $diaryVideoModel ->save();
            }
        }



        return json('success',200);

//            return $data['videos'];


    }
}

        