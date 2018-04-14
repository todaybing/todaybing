<?php
error_reporting(0);
header("Cache-Control: public"); 
header("Pragma: cache"); 
$offset = 60*60*6; // cache 1 day 
$ExpStr = "Expires: ".gmdate("D, d M Y H:i:s", time() + $offset)." GMT"; 
header($ExpStr); 
include('config_qn.php');
include('inc/functions.php'); 
//分页处理  
$arr=array_reverse($ret['items']);
//页码
$p = intval(getParam('page', '1')); 
if($p == '') $p = '1';
$pg=$p-1;
if (count($arr)%9 == 0 ){
	$maxPage=count($arr)/9; 
}
$maxPage=ceil((count($arr)+1)/9); 
$num=count($arr)/9;
$num=explode(".",$num);
$num=substr($num[1],1,1);
//分页处理完成
include('config.php');
//处理bing图存储并上传到七牛 
if(!file_exists($path)){mkdir($path,0777);}
if(!is_file($filePath)){
$str=file_get_contents('http://cn.bing.com/HPImageArchive.aspx?idx=0&n=1');
 if(preg_match("/<urlBase>(.+?)<\/urlBase>/ies",$str,$matches)){
  $imgurl='http://s.cn.bing.com'.$matches[1].'_1920x1080.jpg';
  copy($imgurl,$pathurl);
 }
//上传本地图到七牛云
$token = $auth->uploadToken($bucket);
// 初始化 UploadManager 对象并进行文件的上传。
$uploadMgr = new UploadManager();
list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
}
?>
<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo $webConfig['description']; ?>">
    <meta name="keywords" content="<?php echo $webConfig['keywords']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $webConfig['sitename'];?>-<?php echo $webConfig['slogan'];?></title>
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
       
    <link rel="icon" type="image/png" href="">
    
    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="">
    
    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?php echo $webConfig['sitename'];?>"/>
    <link rel="apple-touch-icon-precomposed" href="">
    
    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="">
    <meta name="msapplication-TileColor" content="#0e90d2">
    
    <link rel="stylesheet" href="assets/css/amazeui.min.css">
    <link rel="stylesheet" href="assets/css/app.css">

    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/amazeui.min.js"></script>
    <script type="text/javascript" src="static/js/amazeui.page.js"></script>
    <!--<![endif]-->
 
    <!--[if lte IE 8 ]>
    <script src="https://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
    <script src="https://static.lylares.com/wd/assets/js/amazeui.ie8polyfill.min.js"></script>
    <![endif]-->
</head>
<body>

<header class="am-topbar">
    <div class="am-container">
    <h1 class="am-topbar-brand hover-bounce">
        <a href="../" class="web-name">
<!--             <span class="am-icon-film am-icon-md"></span> 
 -->           <? echo $webConfig['sitename']; ?>           
        </a>
    </h1>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#doc-topbar-collapse'}">
        <span class="am-sr-only">导航切换</span> 
        <span class="am-icon-bars"></span>
    </button>

  <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav">
        <li><a href="../" >首页</a></li>
    </ul>
  </div>
  </div>
</header>
