<?php
/**
 * Created by PhpStorm.
 * User: dongmingcui
 * Date: 2017/11/17
 * Time: 下午12:30
 */

namespace extend\helper;


class Utils
{

    /**
     *
     * 用户的密码进行加密
     * @param $password
     * @param string $encrypt
     * @return array|string
     */
    public static function genPassword($password, $encrypt = '')
    {
        $pwd = [];
        $pwd['encrypt'] = $encrypt ? $encrypt : self::salt();
        $pwd['password'] = sha1(md5(trim($password)) . $pwd['encrypt']);
        return $encrypt ? $pwd['password'] : $pwd;
    }

    /**
     * 支付密码
     * @param $password
     * @return string
     */
    public static function genPayPassword($password)
    {
        return sha1(md5(trim($password)));
    }
    
    
    /**
     * 生成盐值
     * @return string
     */
    public static function salt()
    {
        return substr(uniqid(), -5);
    }

    /**
     * 生成UUID
     * @param string $prefix 前缀 U 用户 G 商品
     * @return string
     */
    public static function genUUID($prefix = "")
    {
        $uuid = time() . mt_rand(1000000, 9999999);
        $uuid = substr($uuid, 0, 17);
        return $prefix . $uuid;
    }

    /**
     * 生成token
     * @param int $length
     * @return string
     */
    public static function createToken($length = 88)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+=";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }


    /**
     * 获取随机码如验证码
     * @param int $nums
     * @return string
     */
    public static function randNum($nums = 6)
    {
        $num = "";
        for ($i = 0; $i < $nums; $i++) {
            $num .= rand(0, 9);
        }
        return $num;
    }


    /**
     * 处理json
     * @param $str
     * @return array|mixed
     */
    public static function parseJson($str)
    {
        $result = json_decode(str_replace('&quot;', '"', $str), true) ? json_decode(str_replace('&quot;', '"', $str), true) : [];

        return $result;
    }

    /**
     * 生成昵称
     * @param int $length
     * @return string
     */
    public static function createNickname($length = 10)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }


}