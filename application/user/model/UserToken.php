<?php
/**
 * Created by PhpStorm.
 * User: zhanglei
 * Date: 2017/12/6
 * Time: 下午2:48
 */




namespace app\user\model;


use app\common\model\BaseModel;

class UserToken extends BaseModel
{


    protected $table = 'user_token';
    protected $createTime = 'created_at';
    protected $updateTime = false;

    /**
     * @Author zhanglei
     * @DateTime 2017-12-06
     *
     * @description 添加用户token
     * @param array $params
     * @return mixed
     */
    public function tokenAdd(array $params)
    {
        $token = new UserToken($params);
        $token->allowField(true)->save();
        return $token->id;
    }



    /**
     * @Author zhanglei
     * @DateTime 2017-12-06
     *
     * @description 通过uuid修改token
     * @param array $params
     * @return false|int
     */
    public function tokenEdit(array $params)
    {
        $field = ['token_id','device','type','client_version'];

        return UserToken::allowField($field)->save($params,['user_uuid'=>$params['uuid']]);
    }


    /**
     * @Author zhanglei
     * @DateTime
     *
     * @description 获取用户uuid
     * @param string $token
     */
    public function getUuid(string $token)
    {

        return UserToken::where('token_id', $token)->value('user_uuid');


    }


}