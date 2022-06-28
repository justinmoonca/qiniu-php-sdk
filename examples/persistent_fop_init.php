<?php

require_once __DIR__ . '/../autoload.php';

use JQiniu\Auth;
use JQiniu\Config;
use JQiniu\Processing\PersistentFop;

// 控制台获取密钥：https://portal.qiniu.com/user/key
$accessKey = getenv('QINIU_ACCESS_KEY');
$secretKey = getenv('QINIU_SECRET_KEY');
$auth = new Auth($accessKey, $secretKey);

$config = new Config();
$config->useHTTPS=true;

// 初始化
$pfop = new PersistentFop($auth, $config);
