<?php //注意文件的引入路径，其他不需要配置    
error_reporting(0);
require_once('config.php');
require_once __DIR__ . '/qn/autoload.php'; 
use Qiniu\Auth; 
use Qiniu\Storage\BucketManager; 
$auth = new Auth($accessKey, $secretKey);
$bucketManager = new BucketManager($auth);
// 要列取文件的公共前缀
$prefix = '';
// 上次列举返回的位置标记，作为本次列举的起点信息。
$marker = '';
// 本次列举的条目数
$delimiter = '/';
list($ret, $err) = $bucketManager->listFiles($bucket, $prefix, $marker, $limit, $delimiter);
?>

