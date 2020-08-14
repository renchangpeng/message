<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\facade\Route;
Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

Route::rule('index','Index/index');
Route::rule('register','Register/index');
Route::rule('doregister','Register/doregister');
Route::rule('login','Login/index');
Route::rule('dologin','Login/dologin');
Route::rule('loginOut','Login/loginOut');
Route::rule('blog','Blog/index');

Route::rule('message','Message/do_save');

Route::rule('select','Index/select');
Route::rule('update','Index/update');
Route::rule('delete','Index/delete');
Route::rule('doupdate','Index/doupdate');
Route::rule('dz','Index/dz');
Route::rule('qdz','Index/qdz');
Route::rule('zd','Index/zd');
Route::rule('qzd','Index/qzd');

return [

];
