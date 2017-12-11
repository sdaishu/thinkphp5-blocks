<?php
/**
 * Created by PhpStorm.
 * User: dongmingcui
 * Date: 2017/12/8
 * Time: 下午1:32
 */

namespace app\api\controller;

use app\common\controller\BaseController;
use app\user\logic\UserLogic;
use think\Request;

class BaseApi extends BaseController
{
    protected $uuid;

    public function __construct(Request $request = null)
    {
        $this->request = $request;
        $this->user = new UserLogic();

        $params = $this->request->param();
        $this->uuid = $this->user->auth($params);

    }

}