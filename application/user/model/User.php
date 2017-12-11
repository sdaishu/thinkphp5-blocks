<?php
/**
 * Created by PhpStorm.
 * User: zhanglei
 * Date: 2017/12/6
 * Time: 下午2:48
 */

namespace app\user\model;


use app\common\model\BaseModel;

class User extends BaseModel
{


    protected $table = 'user';
    protected $createTime = 'created_at';
    protected $updateTime = false;

    /**
     * @Author zhanglei
     * @DateTime 2017-12-06
     *
     * @description 添加用户
     * @param array $params
     * @return mixed
     */
    public function userAdd(array $params)
    {
        $user = new User($params);
        $user->allowField(true)->save();
        return $user->id;
    }


    /**
     * @Author zhanglei
     * @DateTime 2017-12-06
     *
     * @description 获取用户详情
     * @param string $uuid
     * @return array|false|\PDOStatement|string|Model
     */
    public function userDetail(string $uuid)
    {
        $field = 'uuid,created_at,sex,mobile,portrait,nick_name,login_at';
        return User::field($field)->where('uuid',$uuid)->find();
    }



    /**
     * @Author zhanglei
     * @DateTime 2017-12-06
     *
     * @description 手机号判断用户是否存在
     * @param string $mobile
     * @return int|false
     */
    public function userCountByMobile(string $mobile)
    {

        return User::where('mobile',$mobile)
            ->count();
    }



    /**
     * @Author zhanglei
     * @DateTime 2017-12-06
     *
     * @description 根据手机号更新数据
     * @param string $mobile
     * @param array $params
     * @return int|false
     */
    public function userEditByMobile(string $mobile,array $params)
    {

        return User::allowField(true)->save($params,['mobile'=>$mobile]);
    }


    /**
     * @Author zhanglei
     * @DateTime 2017-12-07
     *
     * @description 获取用户uuid
     * @param string $mobile
     * @return int|false
     */
    public function getUuid(string $mobile)
    {

        $where['mobile'] = $mobile;
        return User::where($where)->value('uuid');
    }


    /**
     * @Author zhanglei
     * @DateTime 2017-12-07
     *
     * @description 修改用户数据
     * @param string $uuid
     * @param array $params
     * @return mixed
     */
    public function userEdit($uuid,array $params)
    {


        return User::allowField(true)->save($params,['uuid'=>$uuid]);
    }


}