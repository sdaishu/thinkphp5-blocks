<?php
/**
 * oss 图片上传
 * User: dongmingcui
 * Date: 2017/11/9
 * Time: 下午2:56
 */

namespace extend\service\storage;

use extend\service\storage\contracts\Storage;
use OSS\OssClient;

class OssService implements Storage
{
    protected $ossClient;

    /**
     * OssService constructor.
     * @param OssClient $ossClient
     */
    public function __construct(OssClient $ossClient)
    {
        $this->ossClient = $ossClient;
    }

    public function upload(array $data = [], $callback = null)
    {
        // TODO: Implement upload() method.
    }

    public function createBase64(array $data = [], $callback = null)
    {
        // TODO: Implement createBase64() method.
    }


}