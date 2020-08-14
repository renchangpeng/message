<?php
namespace app\index\controller;

use app\index\model\User;
use think\Controller;
use think\Db;
use think\facade\Request;

class Register extends Controller
{
    protected $failException = true;
    public function index(){
        //echo 'id:'.$id;
        return $this->fetch('register');
    }
    public function doregister(){
        //echo '注册验证';
        //echo 'id:'.$id;
        $parm = Request::param();
        //dump($parm);
//        if (empty($parm['username'])){
//            $this ->error('请输入用户名！');
//        }
//        if (empty($parm['pwd'])){
//            $this ->error('请输入密码！');
//        }
//        if (empty($parm['rpd'])){
//            $this ->error('请输入确认密码！');
//        }
//        if (empty($parm['name'])){
//            $this ->error('请输入您的昵称！');
//        }
//        if ($parm['pwd'] !== $parm['rpd']){
//            $this ->error('两次密码不一致！');
//        }
        $slect = Db::name('user')->where('username',$parm['username'])->find();
        if (!empty($slect['username'])){
            $this ->error('用户名已存在，请重新注册！');
        }
        $result = $this->validate([
            'username'      =>      $parm['username'],
            'password'      =>      $parm['pwd'],
            'repassword'    =>      $parm['rpd'],
            'name'          =>      $parm['name'],
        ],\app\index\validate\User::class);
        if ($result !== true){
            dump($result);
        }else{
        $user = new User();
        $user ->save( [
            'username'      =>      $parm['username'],
            'password'      =>      $parm['pwd'],
            'name'          =>      $parm['name'],
            'creat_time'    =>      date('Y-m-d H:i:s')
        ]);
        //$insert = Db::name('user')->insert($data,true);
        //return $insert;
        //return $this->redirect('login/index');
        $this->success('注册成功', 'login/index');
        }
    }
}