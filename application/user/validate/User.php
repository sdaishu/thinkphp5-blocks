<?php
/**
 * Created by PhpStorm.
 * User: zhanglei
 * Date: 2017/12/7
 * Time: 下午6:19
 */
namespace app\user\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'page'              =>  'number',
        'size'              =>  'number',
        'mobile'            =>  'number|require',
        'code'              =>  'require',
        'openid'            =>  'require',
        'api_type'          =>  'in:1,2,3',
        'client_version'    =>  'require',
        'device'            =>  'require',
        'type'              =>  'require'
    ];
    protected $message = [
        'page.number'       =>  '页码必须为数字',
        'size.number'       =>  '页数必须为数字',
        'mobile.require'    =>  '手机号不能为空',
        'mobile.number'     =>  '手机号必须为数字',
        'code.require'      =>  '验证码不能为空',
        'openid.require'    =>  'openid不能为空',
        'api_type'          =>  '第三方登录类型必须选择',
        'client_version'    =>  '客户端版本不能为空',
        'device'            =>  '设备号不能为空',
        'type'              =>  '客户端类型不能为空',
    ];
    protected $scene = [
        'codeSend'          =>  ['mobile'],
        'login'             =>  ['mobile','client_version','type','code'],
        'thirdLogin'        =>  ['openid','api_type','client_version','type'],

    ];
}