<?php
/**
 * Created by PhpStorm.
 * User: dongmingcui
 * Date: 2017/12/8
 * Time: 上午10:21
 */

namespace app\backend\model;

use app\common\model\BaseModel;

class Role extends BaseModel
{
    use SoftDelete;

    protected $table = 'backend_roles';

    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $deleteTime = 'deleted_at';

}