<?php    
include('header.php');
?>
<!-- 重写样式 by lylares.com -->
<style>
.web-name {
    color: #0c8484!important;
}
.am-container {
    padding-left: 0;
    padding-right: 0; 
}
.am-alert-secondary {
    background-color: #ddd;
	border-color: #ddd;
    color: #333;
	border-radius: .125rem;
}
.am-gallery-bordered .am-gallery-item {
  box-shadow: 0 0.0625rem 0.125rem rgba(0,0,0,.1);
  border-radius: .125rem;
}

.btn-play-source {
    margin: 0 5px 5px 0;
}
.am-pagination-prev, .am-pagination-next, #selectPage {
    background-color: #fff;
    padding: 5px 10px;
    font-size: 14px;
    line-height: 23px;
    width: auto;
    height: auto;
    color: #444;
    cursor: pointer;
} 
.am-pureview-bar .am-pureview-title {
	word-wrap: break-word; 
    word-break: normal; 
	white-space: pre-line;
	margin-top: 15px;
}
.am-pureview-bar {
	    height:auto;
		line-height:22px;
}
#selectPage {
    padding-right: 0;
    -webkit-appearance: menulist;
    -moz-appearance: menulist;
}
 .am-pagination-select .am-disabled {
    background-color: #F9F9F9;
    cursor: not-allowed;
} 
.am-alert{
	margin:0px 9px 0px 9px;
}
.am-dbtn ,.am-sbtn {
	display: inline-block;
	margin-bottom: 0;
	background-image: none;
	border: 1px solid transparent;
	cursor: pointer;
	outline: 0;
	-webkit-appearance: none;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	-webkit-transition: background-color .3s ease-out,border-color .3s ease-out;
    display: inline-block;
	min-width: 10px;
	padding: .25em .625em;
	font-size: 1.2rem;
	font-weight: 700;
	color: #fff;
	line-height: 1;
	vertical-align: baseline;
	white-space: nowrap;
	text-align: center;
	border-radius: .125rem;
}
.am-sbtn {
	margin-top:12px;
	background-color:#999;
	border-radius: .125rem;
}
.am-pagination {
    text-align: center;
}
</style>

<div class="am-container">
  <!-- 通知消息，config.php里配置 -->
  <?php 
  $states=$message['states'];
  $message=$message['content'];
  if($states == 1){
  echo  
   "<div class='am-alert am-alert-success' data-am-alert>
      <button type='button' class='am-close'>&times;</button>
      <p>$message</p>
    </div>
	";   
  }
   ?>
   <!-- 通知消息结束 -->
	<!--图片区--->
 <ul data-am-widget="gallery" class="am-gallery am-avg-sm-1  am-avg-md-2 am-avg-lg-3  am-gallery-bordered"  data-am-gallery="{pureview:{Preview: 1,weChatImagePreview: false}}">
<?php 
$arr=array_slice($arr,$pg*9,9);
    if($p>$maxPage){
		 echo  
   "<div class='am-alert am-alert-warning' data-am-alert>
      <button type='button' class='am-close'>&times;</button>
      <p>太超前了吧o(╯□╰)o...未能找到美图..</p>
    </div>
	";
	} else {
    if($p==$maxPage){
	  $itm=$num;
	} else {
	  $itm=$pageStyle['pageno'];
	} 
        for($j=0; $j<$itm; $j++) {	
        $str=$arr[$j]["key"];
		$url=$qnurl.$str;
		$nam=str_replace('.jpg','',$str);
		if($AppKey !=''){
		$apk='AppKey='.$AppKey;	
		} else {
		$apk='AppId='.$AppId;		
		}
		$api='https://api.lylares.com/bing/api.php?'.$apk.'&id='.$nam;//原图片信息接口
        $apiData = apiCallback($api); 
        $apiData = json_decode($apiData, true); 
		$ms=$apiData['title'];
		$story=$apiData['story'];
		$cp=$apiData['provider'];
        if($nam==$apiData['date']){
			$nam= strtotime($nam);
			$nam=date('Y年m月d日',$nam);
			$ct=$apiData['Country'];
		    $city=$apiData['City'];
			$Continent=$apiData['Continent'];
			//$originBigImgurl=$apiData['image'];//bing原始1920*1080图片地址，某些地址已失效故此地址弃用
			echoToindex($ms,$nam,$url,$story,$cp,$Continent,$ct,$city,$str);
	
		}   
         	else {
			$Continent=$apiData['location'][0][0];		
			$ct=$apiData['location'][0][1];
		    $city=$apiData['location'][0][2];	
			echoToindex($ms,$nam,$url,$story,$cp,$Continent,$ct,$city,$str);
				}    
}  
}    
        ?>
  </ul>
  <!--图片区结束---> 
  <!-- 分页处理  -->
  <div id="bing-page"></div>
  <script>
  var page = window.location.search.match(/page=(\d+)/);
    $("#bing-page").page({
        pages:<?  echo $maxPage;?>,
        curr:page?page[1]:1,
		first: "首页", //设置false则不显示，默认为false  
        last: "尾页", //设置false则不显示，默认为false 
        jump:window.location.href.split('?')[0]+"?page=%page%"
    })     
  </script>
<!-- 分页处理  -->
 
</div> <!-- 容器结束--> 
<? include('footer.php');?>