<?php 
//error_reporting(0);
include('config.php');
//处理bing接口图存储在本地 
$path='images'.'/';
if(!file_exists($path)){mkdir($path,0777);}
$pathurl =$path.'/'.date('Ymd').'.jpg';
if(!is_file($pathurl)){
$str=file_get_contents('http://cn.bing.com/HPImageArchive.aspx?idx=0&n=1');
 if(preg_match("/<urlBase>(.+?)<\/urlBase>/ies",$str,$matches)){
  $imgurl='http://s.cn.bing.com'.$matches[1].'_1920x1080.jpg';
  copy($imgurl,$pathurl);
 }
}
//上传本地图到七牛云
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
list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
?>
<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo $webConfig['description']; ?>">
    <meta name="keywords" content="<?php echo $webConfig['keywords']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $webConfig['name'];?>-<?php echo $webConfig['slogan'];?></title>
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
       
    <link rel="icon" type="image/png" href="https://static.lylares.com/images/bing.ico">
    
    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="">
    
    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="必应美图"/>
    <link rel="apple-touch-icon-precomposed" href="">
    
    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="">
    <meta name="msapplication-TileColor" content="#0e90d2">
    
    <link rel="stylesheet" href="https://static.lylares.com/wd/assets/css/amazeui.min.css">
    <link rel="stylesheet" href="https://static.lylares.com/wd/assets/css/app.css">
  
    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="https://static.lylares.com/wd/assets/js/jquery.min.js"></script>
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
 -->           必应美图           
        </a>
    </h1>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#doc-topbar-collapse'}">
        <span class="am-sr-only">导航切换</span> 
        <span class="am-icon-bars"></span>
    </button>

  <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav">
        <li><a href="./" >首页</a></li>
		<li><a href="about.php" >关于</a></li>
        <li class="am-dropdown" data-am-dropdown>
            <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                更多 <span class="am-icon-caret-down"></span>
            </a>
            <ul class="am-dropdown-content">
			    <li class="am-divider"></li>
                <li><a href="http://5kvideo.cc" target="_blank">影院</a></li>
		        <li><a href="https://www.lylares.com" target="_blank">博客</a></li>
            </ul>
        </li>
    </ul>
  </div>
  </div>
</header>
