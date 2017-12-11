<?php
/**
 * Created by PhpStorm
 * User: zhanglei
 * Date: 2017/12/6
 * Time: 下午6:11
 */

namespace app\user\model;

use app\common\model\BaseModel;

class UserThird extends BaseModel
{
    protected $table = 'user_third';
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';


    /**
     * @Author zhanglei
     * @DateTime 2017-12-06
     *
     * @description 添加第三方登录
     * @param array $params
     * @return mixed
     */
    public function thirdAdd(array $params)
    {
        $third = new UserThird($params);
        $third->allowField(true)->save();
        return $third->id;
    }


    /**
     * @Author zhanglei
     * @DateTime 2017-12-07
     *
     * @description 第三方参数修改
     * @param array $params
     * @return false|int
     */
    public function thirdEdit(array $params)
    {

        $field = ['access_token','updated_at'];
        return UserThird::allowField($field)->save($params,['user_uuid'=>$params['uuid']]);

    }


    /**
     * @Author zhanglei
     * @DateTime 2017-12-06
     *
     * @description 第三方登录验证
     * @param string $openid  第三方唯一标识
     * @param string $apiType 1:微信  2:qq  3:微博
     * @return false|int
     */
    public function thirdCount(string $openid,string $apiType)
    {
        $where = ['openid'=>$openid, 'api_type'=>$apiType];
        return UserThird::where($where)->count();
    }


    /**
     * @Author zhanglei
     * @DateTime 2017-12-07
     *
     * @description 获取用户uuid
     * @param string $openid
     * @param string $apiType
     * @return mixed
     */
    public function getUuid(string $openid,string $apiType)
    {

        $where['openid'] = $openid;
        $where['api_type'] = $apiType;
        return UserThird::where($where)->value('user_uuid');
    }


}