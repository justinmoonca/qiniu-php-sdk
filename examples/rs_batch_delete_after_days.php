<?php
require_once __DIR__ . '/../autoload.php';

use JQiniu\Auth;
use JQiniu\Config;
use JQiniu\Storage\BucketManager;

// 控制台获取密钥：https://portal.qiniu.com/user/key
$accessKey = getenv('QINIU_ACCESS_KEY');
$secretKey = getenv('QINIU_SECRET_KEY');
$bucket = getenv('QINIU_TEST_BUCKET');


$auth = new Auth($accessKey, $secretKey);
$config = new Config();
$bucketManager = new BucketManager($auth, $config);

// 批量修改文件生命周期，每次最多不能超过 1000 个

$keys = array(
    'qiniu.mp4',
    'qiniu.png',
    'qiniu.jpg'
);

$keyDayPairs = array();

// day=0表示永久存储
foreach ($keys as $key) {
    $keyDayPairs[$key] = 0;
}

$ops = $bucketManager->buildBatchDeleteAfterDays($bucket, $keyDayPairs);
list($ret, $err) = $bucketManager->batch($ops);
if ($err != null) {
    var_dump($err);
} else {
    var_dump($ret);
}
