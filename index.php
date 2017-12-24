<?php    
error_reporting(0);
require_once('con_qn.php');
require_once('header.php');
echo "<script>
 function downfile(str){
        window.location.href=str;
    }
</script>";
?>
<!-- 重写样式 by LYLARES -->
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
</style>

<div class="am-container">

  <?php 
  $message=$message['content'];
  echo  
   "<div class=\"am-alert am-alert-secondary\" data-am-alert>
  <button type=\"button\" class=\"am-close\">&times;</button>
  <p>$message</p>
   </div>"; 
   ?>

    <form class="am-form" id="filter-form">
    <input type="text" name="p" id="movie-p" class="am-hide">
    </form>
	<!--图片区--->
 <ul data-am-widget="gallery" class="am-gallery am-avg-sm-1  am-avg-md-2 am-avg-lg-3  am-gallery-bordered"  data-am-gallery="{pureview:{weChatImagePreview: false}}">
<?php 
$arr=array_slice($arr,$pg*9,9);
    if($p==$maxPage){$itm=$num;}
         else  $itm=9;
        for($j=0; $j<$itm; $j++) {	
        $str=$arr[$j]["key"];
		$url=$qnurl.$str;
		$nam=str_replace('.jpg','',$str);
		$api='https://api.lylares.com/bing/json/'.$nam.'.json';
        $json_string = file_get_contents($api); 
        $apiData = json_decode($json_string, true); 
        if($nam==$apiData['date']){
			$story=$apiData['story'];
			$ms=$apiData['title'];
			$cp=$apiData['provider'];
			$ct=$apiData['Country'];
		    $city=$apiData['City'];
			$Continent=$apiData['Continent'];
			$seh=$apiData['search'];
			$seh=str_replace('http','https',$seh);
			echo "
				<li>
                  <div class='am-gallery-item' title='$ms'>
                      <img src='$url'   alt='$story' /><button type='button'  onclick=\"window.open('$seh')\" class='am-sbtn am-btn-primary am-radius am-fr' title=''><span class='am-icon-search'></span>搜索</button> 
                    <h3 class='am-gallery-title'>$ms</h3>   
                    <div class='am-gallery-desc'>$cp </br><span class='am-badge am-badge am-radius'>$nam</span> <span class='am-badge am-radius'>$Continent</span> <span class='am-badge am-radius'>$ct</span> <span class='am-badge am-radius'>$city</span><button type='button' class='am-dbtn am-btn-primary am-radius am-fr' title=''  onclick=\"downfile('https://resources.lylares.com/bing/download.php?fn=$str');\"><span class='am-icon-cloud-download'></span>立即下载</button></div>
                    </a>
                  </div>
                </li>
				";	
		}   
         	else {
			echo "
				<li>
                  <div class='am-gallery-item' title=\"来自LYLARES'S LAB\">
                      <img  src='$url'   alt='$nam' />
                    <h3 class='am-gallery-title'>哇，太久了..找不到了o(╯□╰)o</h3>
                    <div class='am-gallery-desc'>© Microsoft LYLARES/Test/Bing Images</br><span class='am-badge am-badge  am-radius'>$nam</span>     <button type='button' class='am-dbtn am-btn-primary am-radius am-fr'  title=''  onclick=\"downfile('https://resources.lylares.com/bing/download.php?fn=$str');\"><span class='am-icon-cloud-download'></span>立即下载</button></div>
                    </a>
                  </div>
                </li>
				";	}    
}      
        ?>
  </ul>
  <!--图片区结束--->
  
  <!--翻页按钮--->
    <ul data-am-widget="pagination" class="am-pagination am-pagination-select" >
        <li class="am-pagination-prev" id="prevPage">
            上一页
        </li>  
        <li class="am-pagination-select">
            <select id="selectPage"></select>
        </li>
        <li class="am-pagination-next" id="nextPage">
            下一页
        </li>
    </ul>
  <!--翻页按钮结束--->
</div>  <!-- 容器 -->

<script type="text/javascript">
var pageInfo = {
    curPage: <?php echo $p; ?>,     // 当前页码
    maxPage: <?php echo $maxPage; ?>    // 最大的页码
}
$(function() {
    // 循环添加页码
    for(var i=1; i<=pageInfo.maxPage; i++) {
        $("#selectPage").append('<option value="'+i+'">第 '+i+' 页</option>');
    }
    $("#selectPage").val(pageInfo.curPage);
    
    // 页码选择器改变自动跳转
    $("#selectPage").change(function(){
        goPage($('#selectPage').val());
    });
    
    // 上下翻页功能
    if(pageInfo.curPage < 1) {
        $("#prevPage").addClass("am-disabled");
    }
    if(pageInfo.curPage >= pageInfo.maxPage) {
        $("#nextPage").addClass("am-disabled");
    }
    $("#prevPage").click(function() {
        if(pageInfo.curPage > 1) goPage((parseInt(pageInfo.curPage)-1));
    });
    $("#nextPage").click(function() {
        if(pageInfo.curPage < pageInfo.maxPage) goPage((parseInt(pageInfo.curPage)+1));
    });
    
    // 跳转至指定页码
    function goPage(newPage) {
        $("#movie-p").val(newPage);
        $("#filter-form").submit();
		
    }  
    // 监听筛选表单变化
    $(".filter-change-listen").change(function() {
        $("#filter-form").submit();
    });  
});
    // 保留版权可好
    console.log('来自LYLARES\'S BLOG');
    console.info('Version 1.0, Designed by www.lylares.com.');
   // console.error('版权所有，即将开源！');	
</script>
<!-- 页脚 -->
<?php require_once('footer.php');?>