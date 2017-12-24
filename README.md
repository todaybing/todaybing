### PHP 实现必应每日壁纸+七牛云图片站
本程序实现bing每日图片保存在服务器本地，然后自动上传到七牛云空间，在前端界面展现的图片皆从七牛云获取。

#### 示例网站
https://bing.lylares.com

#### 要求
本程序目前不需要数据库，你需要拥有七牛云空间，在接下来

#### 配置
下载源码，在使用前 务必修改
- config.php文件：
此文件为全局配置文件。

```
<?php
// 网站的一些基础设置
$webConfig = array(
    'siteurl' => '',    // 网站网址如：https://bing.lylares.com/
    'name' => '',    // 网站名称
    'slogan' => '',    // 网站口号 
    'keywords' => '',//关键词
    'description' => '',//描述
	///about页面使用
    'avatar' => '',//头像url
    'avaurl' => '',    //点击头像跳转url
	'nina' => '@LYLARES',//昵称
);
//七牛云配置（必须）
$qnurl = '';//七牛云bucket空间根域名比如：https://sta.lylares.com/
$accessKey = '';//七牛云accessKey
$secretKey = '';//七牛云secretKey
$bucket = '';//七牛云bucket空间名称
$limit = '100000';//需要从七牛云读取的图片张数
$ima=date('Ymd').'.jpg';// 要上传的本地图片名称,当前以年月日：20171214，此处图片名称要和header.php中保存一致
$filePath ='images/'.$ima;// 要上传文件的本地路径
$key = $ima;// 上传到七牛后保存的文件名，当前按照本地图片名称上传
//七牛云配置结束

//首页通知配置
$message = array (
'content' =>'',

);


//关于页面消息配置
$info = array(
   //数字为消息顺序，数字越大消息越靠前 time 为发布时间； content为将要发布的内容；
  //消息设置
  '2' =>array(
    'time' => '2017-12-15 ',
	'content' => '所有的图片都可以直接下载，默认分辨率为：1920*1080',

),
  '1' =>array(
    'time' => '2017-12-14 ',
	'content' => '',

),
);

```
- header.php文件
以下主要用于保存bing图片到本地，
```
$path='images'.'/';//定义保存本地的图片路径
if(!file_exists($path)){mkdir($path,0777);}
$pathurl =$path.'/'.date('Ymd').'.jpg';//拼接本地图片路径名称，此处图片名称要和config.php中$ima保存一致
if(!is_file($pathurl)){
$str=file_get_contents('http://cn.bing.com/HPImageArchive.aspx?idx=0&n=1');
 if(preg_match("/<urlBase>(.+?)<\/urlBase>/ies",$str,$matches)){
  $imgurl='http://s.cn.bing.com'.$matches[1].'_1920x1080.jpg';
  copy($imgurl,$pathurl);
 }
}
```

#### 参考

- [全新的必应美图图片站](https://www.lylares.com/the-new-site-of-bing-everyday-gallery.html)
