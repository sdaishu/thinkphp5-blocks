<?php
/**
 * Created by PhpStorm.
 * User: dongmingcui
 * Date: 2017/12/8
 * Time: 上午10:45
 */


namespace app\backend\validate;

use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'name'  =>  'require|max:25',
        'email' =>  'email',
    ];

    protected $message = [
        'name.require'  =>  '用户名必须',
        'email' =>  '邮箱格式错误',
    ];

    protected $scene = [
        'add'   =>  ['name','email'],
        'edit'  =>  ['email'],
    ];
}