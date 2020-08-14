<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Cookie;
use think\facade\Request;
use think\facade\Session;
use think\facade\Url;

class Login extends Controller
{
    public function index()
    {
        //echo 'login';
        //Url::build('login/dologin');
        return $this->fetch('login');
    }

    public function dologin(){
        //echo '登录验证';
        $parm = Request::param();
        //dump($parm);
        if (empty($parm['username'])){
            $this ->error('用户名不能为空！');
        }
        if (empty($parm['password'])){
            $this ->error('密码不能为空！');
        }
        $db = Db::name('user')->where(['username'=>$parm['username'],'password'=>$parm['password']])->find();
        if (empty($db)){
            $this ->error('用户名密码错误！');
        }
        if ($db['password'] !== ($parm['password'])){
            $this ->error('用户名密码错误！');
        }
        Session::set('user',$db);
        $this->success('正在登录...', \url('Index/index'));

    }
    public function loginOut(){
        Session::clear();
        echo '登录退出';
        $this->success('已注销', \url('Index/index'));
    }
}