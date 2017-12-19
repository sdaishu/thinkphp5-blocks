<?php
/**
 * Created by PhpStorm.
 * User: dongmingcui
 * Date: 2017/12/8
 * Time: 上午10:45
 */


namespace app\backend\validate;

use think\Validate;

class Permission extends Validate
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
        'list'   =>  ['name','email'],
        'detail'   =>  ['name','email'],
        'add'   =>  ['name','email'],
        'edit'  =>  ['email'],
        'delete'  =>  ['email']
    ];
}