<?php

namespace app\api\controller;

/**
 * Class Complete 测试
 * @package app\user\controller
 */
class Cms extends BaseApi
{
    protected $cms;
    protected $cmsValidate;
    protected $request;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);

    }


}
