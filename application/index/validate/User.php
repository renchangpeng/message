<?php

namespace app\index\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    'username|用户名'       =>      'require|max:20|min:5|alphaDash',
        'password|密码'       =>      'require|alphaNum|min:6',
        'repassword|确认密码'     =>      'require|confirm:password',
        'name|昵称'           =>      'require|chsAlphaNum',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'repassword.confirm'        =>      '两次密码不一致',
    ];
}
