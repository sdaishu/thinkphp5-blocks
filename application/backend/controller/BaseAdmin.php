<?php
/**
 * Created by PhpStorm.
 * User: dongmingcui
 * Date: 2017/12/8
 * Time: 上午10:38
 */

namespace app\backend\controller;

use app\common\controller\BaseController;
use think\Request;

class BaseAdmin extends BaseController
{
    protected $request;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);

        $this->request = $request;
    }

}