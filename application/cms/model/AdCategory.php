<?php
/**
 * 广告分类
 * User: dongmingcui
 * Date: 2017/12/19
 * Time: 下午1:06
 */

namespace app\cms\model;

use app\common\model\BaseModel;

class AdCategory extends BaseModel
{
    protected $table = 'cms_ad_category';

    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $deleteTime = 'deleted_at';
}