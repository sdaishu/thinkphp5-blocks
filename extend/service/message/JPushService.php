<?php
/**
 * 极光推送
 * User: dongmingcui
 * Date: 2017/11/9
 * Time: 下午2:56
 */

namespace extend\service\message;

use extend\service\message\contracts\Message;
use JPush\Client as JPush;

class JPushService implements Message
{
    protected $push;

    /**
     * JPushService constructor.
     * @param JPush $client
     */
    public function __construct(JPush $client)
    {
        $this->push = $client;
    }

    public function send(array $data = [], $callback = null)
    {
        // TODO: Implement send() method.
    }

    public function sendAll(array $data = [], $callback = null)
    {
        // TODO: Implement sendAll() method.
    }


}