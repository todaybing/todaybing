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
	'nina' => '',//昵称
);
//七牛云配置（必须）
$qnurl = '';//七牛云bucket空间根域名比如：https://sta.lylares.com/
$accessKey = '';//七牛云accessKey
$secretKey = '';//七牛云secretKey
$bucket = '';//七牛云bucket空间名称
$limit = '100000';//需要从七牛云读取的图片张数
$ima=date('Ymd').'.jpg';// 要上传的本地图片名称,当前以年月日：20171214
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
//打赏设置已经弃用
$pay = array (
    'state' => '1',//开关，默认打开，state为空则关闭打赏
	'title' => '支付宝',
	'url' => '',
	'title1' => '微信',	//第二种
	'url1' => '',
	);
