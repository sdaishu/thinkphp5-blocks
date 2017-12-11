<?php
/**
 * Created by PhpStorm.
 * User: panhao
 * Date: 2017/12/9
 * Time: 上午10:00
 * @introduce  规范参考demo
 */

namespace app\backend\logic;

use think\Exception;
use app\cms\model\Demo;

class DemoLogic extends BaseAdminLogic
{
    protected $demo;

    public function __construct()
    {
        $this->demo=new Demo();
    }

    /**
     * @Author panhao
     * @DateTime 2017-12-09
     *
     * @description 获取全部记录
     * @param array $param
     * @return array
     */
    public function getAll(array $param)
    {
        $param['page'] = $param['page'] ?? 1;
        $param['size'] = $param['size'] ?? 10;
        try {
            $list = $this->demo->getAll($param);

            $result = $this->ajaxSuccess(202, ['list' => $list]);
        } catch (Exception $exception) {

            $result = $this->ajaxError(205);
        }
        return $result;
    }

    /**
     * @Author panhao
     * @DateTime 2017-12-09
     *
     * @description 新增记录
     * @param array $param
     * @return array
     */
    public function addDemo(array $param)
    {
        try {

            $data = $this->demo->addDemo($param);

            if ($data) {
                $result = $this->ajaxSuccess(200);
            } else {
                $result = $this->ajaxError(206);
            }

        } catch (Exception $exception) {

            $exception->getMessage();
            $result = $this->ajaxError(206);
        }

        return $result;
    }

    /**
     * @Author panhao
     * @DateTime 2017-12-09
     *
     * @description 更新记录
     * @param array $param
     * @return array
     */
    public function editDemo(array $param)
    {
        try {

            $data = $this->demo->editDemo($param);
            if ($data) {
                $result = $this->ajaxSuccess(201);
            } else {
                $result = $this->ajaxError(207);
            }

        } catch (Exception $exception) {

            $result = $this->ajaxError(207);
        }

        return $result;
    }


    /**
     * @Author panhao
     * @DateTime 2017-12-09
     *
     * @description 删除记录
     * @param array $param
     * @return array
     */
    public function delDemo(array $param)
    {
        try {
            $data = $this->demo->delDemo($param['id']);

            if ($data) {
                $result = $this->ajaxSuccess(203);
            } else {
                $result = $this->ajaxError(204);
            }


        } catch (Exception $exception) {
            $result = $this->ajaxError(204);
        }

        return $result;
    }

    /**
     * @Author panhao
     * @DateTime 2017-12-09
     *
     * @description 查询详情
     * @param array $param
     * @return array
     */
    public function getRowsById(array $param)
    {
        try {
            $data = $this->demo->getRowsById($param);

            $result = $this->ajaxSuccess(202, ['list' => $data]);
        } catch (Exception $exception) {

            $result = $this->ajaxError(205);
        }

        return $result;
    }
}