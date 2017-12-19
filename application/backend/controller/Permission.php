<?php
/**
 * Created by PhpStorm.
 * User: dongmingcui
 * Date: 2017/12/8
 * Time: 上午10:39
 */

namespace app\backend\controller;


use think\Request;

class Permission extends Basepermission
{
    protected $permissionLogic;
    protected $permissionValidate;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    /**
     * 权限列表
     */

    public function permissionList()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->permissionValidate, 'list', $params);
    }

    /**
     * 权限详情
     */
    public function permissionDetail()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->permissionValidate, 'detail', $params);
    }

    /**
     * 添加权限
     */
    public function permissionAdd()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->permissionValidate, 'add', $params);
    }

    /**
     * 编辑权限
     */
    public function permissionEdit()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->permissionValidate, 'edit', $params);
    }

    /**
     * 删除权限
     */
    public function permissionDelete()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->permissionValidate, 'delete', $params);
    }

}