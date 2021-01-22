### PHP 实现必应每日壁纸+七牛云图片站
本程序实现bing每日图片保存在服务器本地，然后自动上传到七牛云空间，在前端界面展现的图片皆从七牛云获取。
#### 更新
2018.04.04 更新：
1.接口以及部分样式更新，和示例站保持一致
2.代码结构更新，配置config.php即可

#### 示例网站
原演示站关闭了现在跳转另一个体验更好的：
https://bing.lylares.com

#### 要求
本程序目前不需要数据库，你需要拥有七牛云空间，在接下来的基本配置中需要七牛云的相关资源。

#### 配置
下载源码，在使用前 务必修改
- config.php文件：
此文件为全局配置文件。

```
<?php
// 网站的一些基础设置
$webConfig = array(
    'siteurl' => '',    // 网站网址如：https://www.todaybing.com
    'sitename' => '',    // 网站名称
    'slogan' => '',    // 网站口号 
    'keywords' => '',//关键词
    'description' => '',//描述
	'copyright' => '',//版权信息
	'beian' => '',///备案号
);
//在open.lylares.com新申请的AppKey或者以前申请的旧的AppId，配置其中一个即可
$AppKey='';
$AppId='';
//

/*七牛云配置*/
//七牛云bucket空间根域名 ,例如：https://www.todaybing.com/
$qnurl = '';
//七牛云accessKey 
$accessKey = '';
//七牛云secretKey
$secretKey = '';
//七牛云bucket空间名称
$bucket = '';
//需要从七牛云读取的图片张数
$limit = '1000000';
// 要上传文件的本地图片名称，目前以时间序列命名，不建议修改
$ima=date('Ymd').'.jpg';
// 要上传文件的本地路径，[bing/images/] 这部分目录你可以更改但是请拼接 $ima 以构造图片完整本地路径,无需手动创建
$path= 'bing/images/';
$filePath =$path.$ima; 
// 上传到七牛后保存的文件名，不建议更改
$key = $ima;
/*七牛云配置结束*/


/*首页通知配置*/
$message = array (
'states' =>0,//开关消息，0默认关闭消息，1打开消息
'content' =>'温馨提示：',
);
/*首页通知配置*/

/*样式配置*/
$pageStyle = array (
  'pageno'  => 9, //每页显示图片数 3的整数倍最佳，否则自己修改css
);
/*样式配置*/


```
#### 参考

- [全新的必应美图图片站](https://www.lylares.com/the-new-site-of-bing-everyday-gallery.html)
