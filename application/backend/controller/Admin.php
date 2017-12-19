<?php
/**
 * Created by PhpStorm.
 * User: dongmingcui
 * Date: 2017/12/8
 * Time: 上午10:36
 */

namespace app\backend\controller;

use app\backend\logic\AdminLogic;
use think\Request;

class Admin extends BaseAdmin
{
    protected $accountLogic;
    protected $adminValidate;

    /**
     * Admin constructor.
     * @param Request|null $request
     */
    public function __construct(Request $request = null)
    {
        parent::__construct($request);

        $this->accountLogic = new AdminLogic();
        $this->adminValidate = new \app\backend\validate\Admin();
    }


    /**
     * 管理员列表
     */
    public function adminList()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->adminValidate, 'list', $params);
    }

    /**
     * 管理员详情
     */
    public function adminDetail()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->adminValidate, 'detail', $params);
    }

    /**
     * 添加管理员
     */
    public function adminAdd()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->adminValidate, 'add', $params);
    }

    /**
     * 编辑管理员
     */
    public function adminEdit()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->adminValidate, 'edit', $params);
    }

    /**
     * 删除管理员
     */
    public function adminDelete()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->adminValidate, 'delete', $params);
    }

}