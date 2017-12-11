<?php
/**
 * 创蓝短信
 * User: dongmingcui
 * Date: 2017/12/6
 * Time: 下午5:29
 */

namespace extend\service\message;

use extend\service\message\contracts\Message;

class BlueService implements Message
{
    protected $blue;

    /**
     * JPushService constructor.
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->blue = $message;
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