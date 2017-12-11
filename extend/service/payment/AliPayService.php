<?php
/**
 * Created by PhpStorm.
 * User: dongmingcui
 * Date: 2017/11/14
 * Time: 上午11:22
 */

namespace extend\service\payment;

use extend\service\payment\contracts\Payment;

class AliPayService implements Payment
{

    /**
     * AliPayService constructor.
     */
    public function __construct()
    {
    }

    public function payInfo(array $data = [], $callback = null)
    {
        // TODO: Implement payInfo() method.
    }

    public function notifyCallback(array $data = [], $callback = null)
    {
        // TODO: Implement notifyCallback() method.
    }


}