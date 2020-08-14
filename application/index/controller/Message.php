<?php

namespace app\index\controller;

use think\Controller;
use think\facade\Cookie;

class Message extends Controller
{
    public function checklogin(){
            if (empty(Cookie::get('username','think_'))){
                $this->error('请登录后操作',\url('Login/index'));
            }
    }
    public function do_save(){
        $this->checklogin();
        $parm = input('post.');
        if (empty($parm['message'])){
            $this->error('留言不能为空！');
        }
        else{
            $userid = Cookie::get('user_id','think_');
            //$username = Cookie::get('username','think_');
            $message = new \app\index\model\Message();
            $message -> save([
                'user'      =>      $parm['user'],
                'connent'   =>      $parm['message'],
                'time'      =>      date('Y-m-d H:i:s'),
                'user_id'   =>      $userid,
            ]);
            if ($message){
                $this->success('留言成功！', url('Index/index'));
            }
            else{
                $this->error('留言失败！');
            }
        }
    }
}