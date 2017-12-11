<?php
/**
 * Created by PhpStorm.
 * User: dongmingcui
 * Date: 2017/11/17
 * Time: 下午12:40
 */

namespace extend\helper;


class Curl
{


    /**
     * 执行curl
     * @param string $url
     * @param string $method
     * @param string $data
     */
    public static function executeCurl($url = '', $method = 'post', $data = '')
    {
        $ch = curl_init();
        //调用接口方式
        if (strtoupper($method) == 'POST') {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
    }

    /**
     * 获得文件大小
     * @param $imgUrl
     * @return mixed
     */
    public static function getFileSize($imgUrl)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $imgUrl);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 60);
        $buf = curl_exec($c);
        $info = json_decode($buf);
        return $info->FileSize->value;
    }

    /**
     * 下载
     * @param string $url
     * @param string $path
     */
    protected function download(string $url, string $path)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        $file = curl_exec($ch);
        curl_close($ch);
        is_dir($pdir = dirname($path)) or mkdir($pdir, 0777, true);
        $resource = fopen($path, 'w');
        fwrite($resource, $file);
        fclose($resource);
    }

    /**
     * 建立curl连接
     * @param $url
     * @param $params
     * @param string $method
     * @param array $header
     * @param bool $multi
     * @return mixed|string
     */
    protected function buildHttp($url, $params, $method = 'GET', $header = [], $multi = false)
    {
        $opts = [
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER => $header
        ];


        /* 根据请求类型设置特定参数 */
        switch (strtoupper($method)) {
            case 'GET':
                $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
                break;
            case 'POST':
                //判断是否传输文件
                $params = $multi ? $params : http_build_query($params);
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_POST] = 1;
                $opts[CURLOPT_SSL_VERIFYPEER] = 1;
                $opts[CURLOPT_HEADER] = false;
                $opts[CURLOPT_TIMEOUT] = 30;
                $opts[CURLOPT_RETURNTRANSFER] = true;
                $opts[CURLOPT_POSTFIELDS] = $params;

                break;
            default:
                throw new Exception('不支持的请求方式！');
        }

        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if ($error)
            return $error;
        return $data;
    }
}