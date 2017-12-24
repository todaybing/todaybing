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
// 列举文件
list($ret, $err) = $bucketManager->listFiles($bucket, $prefix, $marker, $limit, $delimiter);
if ($err !== null) {
   // echo "\n====> list file err: \n";
   // var_dump($err);
} else {
   if (array_key_exists('marker', $ret)) {
       // echo "Marker:" . $ret["marker"] . "\n";
   }  
$arr=array_reverse($ret['items']);
   function getParam($key,$default='')
{
    return trim($key && is_string($key) ? (isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : $default)) : $default);
}
$p = intval(getParam('p', '1')); 
if($p == '') $p = '1';
$pg=$p-1;
if (count($arr)%9 ==0 ){
	$maxPage=count($arr)/9; 
}
$maxPage=ceil((count($arr)+1)/9); 
$num=count($arr)/9;
$num=explode(".",$num);
$num=substr($num[1],1,1);
}