<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Cookie;
use think\facade\Request;
use app\index\model\Message;
use think\facade\Session;

class Index extends Controller
{
    public function index()
    {
        //return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';

        //获取Session
        $result = Session::get('user');
        //dump($result);
        //查询留言
        $list = Db::name('message')->order('flag','desc')->order('id','desc')->paginate(5);
        $page = $list->render();
        //dump($list);
        $this->assign('list',$list);
        $this->assign('page', $page);
        $this->assign('title','留言板主页');
        $this->assign('result',$result);
        return $this->fetch('index');
    }

    public function select()
    {
        $request = Request::instance();
        $id = $request->param('messageId');
        //dump($id);
        $parm = Db::name('message')->where('id',$id)->select();
        //dump($parm);
        $this->assign('parm',$parm);
        //echo '查看留言';
        return $this->fetch('read');
    }

    public function delete(){
        $request = Request::instance();
        $id = $request->param('messageId');
        //dump($id);
        $parm = Db::name('message')->where('id',$id)->delete();
        if ($parm>0){
            $this->success('删除成功！',url('Index/index'));
        }
        else{
            $this->error('删除失败！');
        }
        //echo '删除留言';
    }

    public function update(){
        $request = Request::instance();
        $id = $request->param('messageId');
        //dump($id);
        $parm = Db::name('message')->where('id',$id)->select();
        //dump($parm);
        $this->assign('parm',$parm);
        //echo '查看留言';
        return $this->fetch('update');
        echo '修改留言';
    }

    public function doupdate(){
        $parm = Request::param();
        $update = Db::name('message')
            ->where('user',$parm['user'])
            ->data([
                'user'      =>      $parm['user'],
                'connent'   =>      $parm['message']
            ])->update();
        if ($update){
            $this->success('修改成功！',url('Index/index'));
        }
        else{
            $this->error('修改失败');
        }
        //echo '修改留言成功';
    }

    public function dz(){
        //echo '点赞';
        $request = Request::instance();
        $id = $request->param('messageId');
        $rs = Db::name('message')->where('id',$id)->select();
            $parm = Db::name('message')->where('id', $id)
                ->data(['dz_id' => 1])->setInc('dianzan');
           $this->success('点赞成功！', \url('Index/index'));

    }

    public function qdz(){
        //echo '取消点赞';
        $request = Request::instance();
        $id = $request->param('messageId');
        //$rs = Db::name('message')->where('id',$id)->select();
        $parm = Db::name('message')->where('id',$id)
            ->data(['dz_id'=>0])->setDec('dianzan');
        $this->success('取消点赞成功！', \url('Index/index'));
    }

    public function zd(){
        $request = Request::instance();
        $id = $request->param('messageId');
        $parm = Db::name('message')->where('id',$id)
            ->data(['flag' => 1])->update();
        $this->success('置顶成功！',url('Index/index'));
    }

    public function qzd(){
        $request = Request::instance();
        $id = $request->param('messageId');
        $parm = Db::name('message')->where('id',$id)
            ->data(['flag' => 0])->update();
        $this->success('取消置顶成功！',url('Index/index'));
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
