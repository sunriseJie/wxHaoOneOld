<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],

// ];
// 

//使用动态注册路由，这里定义了之后PathInfo模式会失效。
use think\Route;


Route::group('api/:version/diary', function () {
//
    Route::get('', 'api/:version.Diary/getDiary');
    Route::post('', 'api/:version.Diary/createDiary');
//    Route::get('/:showDetail/:count/:start', 'api/:version.Diary/getDiary');

});

Route::post('api/:version/upload','api/:version.Upload/uploadImagesAndVideos');

//Route::post('api/:version/upload','api/:version.Upload/test');