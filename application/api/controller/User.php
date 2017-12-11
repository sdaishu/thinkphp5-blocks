<?php
/**
 * Created by PhpStorm
 * User: zhanglei
 * Date: 2017/12/7
 * Time: 下午4:41
 */

namespace app\api\controller;


use app\user\logic\UserLogic;
use think\Request;

class User extends BaseApi
{

    protected $user;
    protected $userValidate;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->user = new UserLogic();
        $this->userValidate = new \app\user\validate\User();
        $this->request = $request;
    }


    /**
     * @api {post} /api/user/codeSend 发送验证码
     * @apiGroup user
     * @apiName  codeSend
     * @apiVersion 1.0.0
     * @apiParam {string} mobile 手机号
     * @apiSuccess {int} status 调用状态 1-调用成功 0-调用失败
     * @apiSuccess {int} code   状态响应码 为0时表示无错误发生，大于0时表示发生了特定错误
     * @apiSuccess {string} message 提示消息
     * @apiSuccess {Object} data 数据部分,忽略
     * @apiSampleRequest https://miyin.my/api/user/codeSend
     * @apiSuccessExample {json} Response 200 Example
     * {
     *   "status": 1,
     *   "message": "发送成功",
     *   "data": [],
     *   "code": 0
     * }
     */
    public function codeSend()
    {
        $params = $this->request->param();
        $mobile = $params['mobile'];
        $this->paramsValidate($this->userValidate, 'codeSend', $params);

        $result = $this->user->codeSend($mobile);
        return $result;
    }


    /**
     * @api {post} /api/user/login 手机号登录
     * @apiGroup user
     * @apiName  login
     * @apiVersion 1.0.0
     * @apiParam {string} mobile 手机号
     * @apiParam {string} client_version 客户端版本
     * @apiParam {int} type 客户端类型 1:客户端 2:后台
     * @apiSuccess {int} status 调用状态 1-调用成功 0-调用失败
     * @apiSuccess {int} code   状态响应码 为0时表示无错误发生，大于0时表示发生了特定错误
     * @apiSuccess {string} message 提示消息
     * @apiSuccess {Object} data 数据部分,忽略
     * @apiSuccess {Object} userDetail 用户详情,忽略
     * @apiSuccess {string} uuid 用户UUID
     * @apiSuccess {string} created_at 创建时间
     * @apiSuccess {string} sex 性别  0:未知 1:男 2:女
     * @apiSuccess {string} mobile 手机号
     * @apiSuccess {string} portrait 头像
     * @apiSuccess {string} nick_name 昵称
     * @apiSuccess {string} login_at 登录时间
     * @apiSuccess {string} token_id token
     * @apiSampleRequest https://miyin.my/api/user/login
     * @apiSuccessExample {json} Response 200 Example
     * {
     *    "status": 1,
     *     "message": "登录成功",
     *     "data": {
     *     "userDetail": {
     *     "uuid": "15128223311082882",
     *     "created_at": "2017-12-09 20:25:31",
     *     "sex": 0,
     *     "mobile": "15968401479",
     *     "portrait": "",
     *     "nick_name": "miyinry8smjl2el",
     *     "login_at": "2017-12-09 08:27:55",
     *     "token_id": ""
     *     }
     *     },
     *     "code": 200
     *  }
     */

    /**
     * @Author zhanglei
     * @DateTime
     *
     * @description
     * @param Request $request
     * @return array
     */


    public function login()
    {


        $params = $this->request->param();
        $this->paramsValidate($this->userValidate, 'login', $params);

        $result = $this->user->login($params);
        return $result;

    }


    /**
     * @api {post} /api/user/thirdLogin 第三方登录
     * @apiGroup user
     * @apiName  thirdLogin
     * @apiVersion 1.0.0
     * @apiParam {string} openid 第三方唯一标识
     * @apiParam {string} appid QQ登陆需要
     * @apiParam {string} portrait 头像
     * @apiParam {int} sex 性别 0:未知 1:男 2:女
     * @apiParam {string} client_version 客户端版本
     * @apiParam {int} api_type 类型  1:微信, 2:qq, 3:微博
     * @apiParam {int} type 客户端类型 1:客户端  2:后台
     * @apiSuccess {int} status 调用状态 1-调用成功 0-调用失败
     * @apiSuccess {int} code   状态响应码 为0时表示无错误发生，大于0时表示发生了特定错误
     * @apiSuccess {string} message 提示消息
     * @apiSuccess {Object} data 数据部分,忽略
     * @apiSuccess {Object} userDetail 用户详情,忽略
     * @apiSuccess {string} uuid 用户UUID
     * @apiSuccess {string} created_at 创建时间
     * @apiSuccess {string} sex 性别  0:未知 1:男 2:女
     * @apiSuccess {string} mobile 手机号
     * @apiSuccess {string} portrait 头像
     * @apiSuccess {string} nick_name 昵称
     * @apiSuccess {string} login_at 登录时间
     * @apiSuccess {string} token_id token
     * @apiSampleRequest https://miyin.my/api/user/thirdLogin
     * @apiSuccessExample {json} Response 200 Example
     * {
     *    "status": 1,
     *     "message": "登录成功",
     *     "data": {
     *     "userDetail": {
     *     "uuid": "15128223311082882",
     *     "created_at": "2017-12-09 20:25:31",
     *     "sex": 0,
     *     "mobile": "15968401479",
     *     "portrait": "",
     *     "nick_name": "miyinry8smjl2el",
     *     "login_at": "2017-12-09 08:27:55",
     *     "token_id": ""
     *     }
     *     },
     *     "code": 200
     *  }
     */

    public function thirdLogin()
    {

        $params = $this->request->param();
        $this->paramsValidate($this->userValidate, 'thirdLogin', $params);

        $result = $this->user->thirdLogin($params);
        return $result;

    }


    public function notoken(Request $request)
    {
        $data = "不需要token";

        return $data;
    }


    public function usetoken(Request $request)
    {

        $data = "uuid=".$this->uuid;

        return $data;

    }






}