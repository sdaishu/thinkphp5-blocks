<?php
/**
 * Created by PhpStorm.
 * User: dongmingcui
 * Date: 2017/12/8
 * Time: 上午10:37
 */

namespace app\backend\controller;


use think\Request;

class Role extends Baserole
{
    protected $roleLogic;
    protected $roleValidate;

    /**
     * Role constructor.
     * @param Request|null $request
     */
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    /**
     * 角色列表
     */
    public function roleList()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->roleValidate, 'list', $params);
    }

    /**
     * 角色详情
     */
    public function roleDetail()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->roleValidate, 'detail', $params);
    }

    /**
     * 添加角色
     */
    public function roleAdd()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->roleValidate, 'add', $params);
    }

    /**
     * 编辑角色
     */
    public function roleEdit()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->roleValidate, 'edit', $params);
    }

    /**
     * 删除角色
     */
    public function roleDelete()
    {
        $params = $this->request->param();
        $this->paramsValidate($this->roleValidate, 'delete', $params);
    }
    
    

}