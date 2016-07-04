<?php
/**
 * Created by PhpStorm.
 * User: vluo
 * Date: 16-2-16
 * Time: 下午2:43
 */

require "autoload.php";
require "Common.php";

use OSS\OssClient;
use OSS\Core\OssException;

class  Uploader {
    private static $client;
    private static $bucket;



    function uploadFile($filePath, $object, $delOriginFile=FALSE)
    {
        $bucket = Common::getBucketName();
        $ossClient = Common::getOssClient();
        if (is_null($ossClient)) return FALSE;

        // 上传本地文件
        try{
            $ossClient->uploadFile($bucket, $object, $filePath);
            if($delOriginFile) {
                @unlink($filePath);
            }
        } catch(OssException $e) {
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return FALSE;
        }
        //print(__FUNCTION__ . ": OK" . "\n");
        return  true;
    }
}