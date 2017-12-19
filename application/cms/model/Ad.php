<?php
/**
 * 广告
 * User: dongmingcui
 * Date: 2017/12/19
 * Time: 下午1:06
 */

namespace app\cms\model;

use app\common\model\BaseModel;

class Ad extends BaseModel
{
    protected $table = 'cms_ad';

    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $deleteTime = 'deleted_at';
}