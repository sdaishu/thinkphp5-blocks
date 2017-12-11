<?php
/**
 * Created by PhpStorm.
 * User: dongmingcui
 * Date: 2017/12/8
 * Time: 上午10:36
 */

namespace app\backend\controller;


use app\backend\logic\AccountLogic;
use think\Request;

class Admin extends BaseAdmin
{
    protected $accountLogic;
    protected $adminValidate;
    protected $request;

    /**
     * Admin constructor.
     * @param Request|null $request
     */
    public function __construct(Request $request = null)
    {
        parent::__construct($request);

        $this->accountLogic = new AccountLogic();
        $this->adminValidate = new \app\backend\validate\Admin();
        $this->request = $request;

    }

    public function adminList()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->adminValidate, 'list', $params);
    }

    public function adminDetail()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->adminValidate, 'detail', $params);
    }

    public function adminAdd()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->adminValidate, 'add', $params);
    }

    public function adminEdit()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->adminValidate, 'edit', $params);
    }

    public function adminDelete()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->adminValidate, 'delete', $params);
    }

}