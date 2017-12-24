<?php
//本文件只需要注意引入的文件路径，其他不需要配置  
require_once __DIR__ . '/qn/autoload.php';
require_once('config.php');
// 引入鉴权类
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;

// 构建鉴权对象
$auth = new Auth($accessKey, $secretKey);

// 生成上传 Token
$token = $auth->uploadToken($bucket);

// 初始化 UploadManager 对象并进行文件的上传。
$uploadMgr = new UploadManager();

// 调用 UploadManager 的 putFile 方法进行文件的上传。
list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
//echo "\n====> putFile result: \n";
//if ($err !== null) {
  //  var_dump($err);
//} else {
  //  var_dump($ret);
//}
?>
