<?php
/**
 * 支付
 * User: dongmingcui
 * Date: 2017/12/6
 * Time: 下午5:11
 */

namespace extend\service\payment\contracts;

interface Payment
{
    /**
     * @param array $data
     * @param null $callback
     * @return mixed
     */
    public function payInfo(array $data = [], $callback = null);

    /**
     * @param array $data
     * @param null $callback
     * @return mixed
     */
    public function notifyCallback(array $data = [], $callback = null);



}