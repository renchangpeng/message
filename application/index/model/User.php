<?php
namespace app\index\model;

use think\Model;

class User extends Model
{
    //protected $table = 'user';
    //开启自动时间戳
    protected $autoWriteTimestamp = 'datetime';
}