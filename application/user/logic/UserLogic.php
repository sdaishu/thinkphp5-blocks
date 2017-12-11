<?php
/**
 * Created by PhpStorm.
 * User: dongmingcui
 * Date: 2017/11/9
 * Time: 下午2:41
 */

namespace app\user\logic;


use app\user\model\User;
use app\user\model\UserThird;
use app\user\model\UserToken;
use extend\helper\Utils;
use app\common\logic\BaseLogic;
use app\message\logic\SmsLogic;
use think\Db;
use think\Exception;
use think\Request;

class UserLogic extends BaseLogic
{


    protected $userModel;
    protected $tokenModel;
    protected $thirdModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->tokenModel = new UserToken();
        $this->thirdModel = new UserThird();
    }


    /**
     * @Author zhanglei
     * @DateTime 2017-12-06
     *
     * @description 登录时添加用户
     * @param int $type 1:手机登录 2:第三方登录
     * @param array $params
     * @return array
     */
    public function userAdd(int $type, array $params)
    {

        Db::startTrans();
        try {


            $nickName = config('nick_prefix').Utils::createNickname();
            $uuid = Utils::genUUID();
            $tokenId = Utils::createToken();

            $params['nick_name'] = $nickName;
            $params['uuid'] = $uuid;
            $params['login_at'] = config('thistime');
            $uid = $this->userModel->userAdd($params);

            $params['token_id'] = $tokenId;
            $params['user_uuid'] = $uuid;

            $tid = $this->tokenModel->tokenAdd($params);
            if($type==2) {
                $thirdId = $this->thirdModel->thirdAdd($params);
            }else{
                $thirdId = 1;
            }

            if ($uid > 0 && $tid>0 && $thirdId>0) {

                Db::commit();
                $detail = $this->userModel->userDetail($uuid);
                $detail['token_id'] = $tokenId;

                $result = $this->ajaxSuccess(200,['userDetail'=>$detail], '登录成功');
            }else{
                Db::rollback();
                $result = $this->ajaxError(201, [], '登录失败');
            }
        }catch (Exception $exception) {
            Db::rollback();
            $result = $this->ajaxError(201, [], '登录失败');
        }
        return $result;
    }


    /**
     * @Author zhanglei
     * @DateTime 2017-12-06
     *
     * @description 登录时修改用户
     * @param int $type 1:手机登录 2:第三方登录
     * @param array $params
     * @return array
     */
    public function userEdit(int $type, array $params) {

        Db::startTrans();
        try {

            $data['login_at'] = config('thistime');
            $params['token_id'] = Utils::createToken();
            $tokenId = Utils::createToken();

            if($type==2){
                $openid = $params['openid'];
                $apiType = $params['api_type'];
                $uuid = $this->thirdModel->getUuid($openid, $apiType);
            }else{
                $mobile = $params['mobile'];
                $uuid = $this->userModel->getUuid($mobile);
            }


            $params['token_id'] = $tokenId;
            $params['uuid'] = $uuid;


            $editUserResult = $this->userModel->userEdit($uuid, $data);

            $editTokenResult = $this->tokenModel->tokenEdit($params);
            if($type==2){

                $editThirdResult = $this->thirdModel->thirdEdit($params);
            }else{
                $editThirdResult = true;
            }


            if($editUserResult && $editTokenResult && $editThirdResult) {
                Db::commit();
                $detail = $this->userModel->userDetail($uuid);
                $detail['token_id'] = $tokenId;
                $result = $this->ajaxSuccess(200, ['userDetail'=>$detail], '登录成功');
            }else{
                Db::rollback();

                $result = $this->ajaxError(201, [], '登录失败');
            }


        }catch (Exception $exception){
            Db::rollback();
            echo $exception;exit;
            $result = $this->ajaxError(201, [], '登录失败');
        }

        return $result;

    }



    /**
     * @Author zhanglei
     * @DateTime 2017-12-07
     *
     * @description 用户登录
     * @param array $params
     * @return array
     */
    public function login(array $params)
    {

        try {

            $mobile = $params['mobile'];
            $code = $params['code'];
            //$sendCode = session('code_verify_'.$mobile) ? session('code_verify_'.$mobile) : '';
            $sendCode = 1111;
            $result = $this->checkCode($code, $sendCode);

            if($result['status']==1) {

                $count = $this->userModel->userCountByMobile($mobile);//判断用户是否存在
                if($count>0) {
                    $result = $this->userEdit(1, $params);
                }else{
                    $result = $this->userAdd(1, $params);
                }

            }
        }catch (Exception $exception) {
            echo $exception;exit;
            $result = $this->ajaxError(1005);
        }

        return $result;

    }



    /**
     * @Author zhanglei
     * @DateTime 2017-12-07
     *
     * @description 第三方登录
     * @param array $params
     * @return array
     */
    public function thirdLogin(array $params)
    {
        try {

            $openid = $params['openid'];
            $apiType = $params['api_type'];
            $count = $this->thirdModel->thirdCount($openid, $apiType);


            if($count>0) {
                $result = $this->userEdit(2, $params);
            }else{
                $result = $this->userAdd(2, $params);
            }

        }catch (Exception $exception) {
            $result = $this->ajaxError(1005);
        }


        return $result;

    }




    /**
     * @Author zhanglei
     * @DateTime 2017-12-07
     *
     * @description 验证码是否正确
     * @param string $code 用户输入
     * @param string $sendCode 系统发送
     * @return array
     */
    public function checkCode(string $code, string $sendCode)
    {

        try {
            if($code==$sendCode){
                $result = $this->ajaxSuccess(300);
            }else{
                $result = $this->ajaxError(301);
            }
        }catch (Exception $exception) {
            $result = $this->ajaxError(301);
        }

        return $result;


    }



    /**
     * @Author zhanglei
     * @DateTime 2017-12-07
     *
     * @description 发送验证码
     * @param string $mobile 手机号
     * @param int $type 发送模版
     * @return mixed
     */
    public function codeSend(string $mobile, int $type = 1)
    {
        $smsLogic = new SmsLogic();
        $params['mobile'] = $mobile;
        $params['type'] = $type;
        $result = $smsLogic->smsVerify($params);

        return $result;

    }

    /**
     * @Author zhanglei
     * @DateTime 2017-12-11
     *
     * @description 用户登录验证
     * @param array $params
     * @return int|mixed
     */
    public function auth(array $params)
    {

        $uuid = 0;
        try {

            $token = isset($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : "";
            $authList = config('auth');
            $request = Request::instance();
            $url = $request->baseUrl();
            $urlList = explode("/",$url);
            $actionName = $urlList[count($urlList)-1]; //获取当前的路由名

            if (!in_array($actionName, $authList)) {
                if (!isset($token) || empty($token)) {

                    $result = $this->ajaxError(1004);

                } else {
                    $uuid = $this->tokenModel->getUuid($token);
                    $uuid = empty($uuid) || is_null($uuid) ? 0 : $uuid;
                    if($uuid == 0) {
                        $result = $this->ajaxError(1005);
                    }

                }
            }
        }catch (Exception $exception) {
            echo $exception;exit;
            $result = $this->ajaxError(1004);
        }
        if(!empty($result)) {
            echo json_encode($result);exit;
        }
        return $uuid;

    }





}