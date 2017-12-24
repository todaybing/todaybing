<?php 
include('header.php');?>
<style>
.web-name {
color: #0c8484!important;
}
.am-article-bd > p {
margin-left:9px;
margin-right:8px;
}
.pay > ul {
display: table;
margin:0 auto;
height:200px;
text-align: center;
padding:0;
}
.pay > ul > li {
float: left;
margin-left: 20px;
padding:0;
width:200px;
height:210px;
line-height:0px;
font-size: 14px;
list-style-type: none;
}

.bg
{
color:#fff!important;
width:100%;
height:18em;
background-size:100%;
background:url("https://bm.lylares.com/20171116.jpg") repeat ;
text-align: center!important;

}
.bg > h2 {
	color:#000!important;
font-size: 1.9rem;
font-weight: 400;
margin-bottom: .5rem;	
padding-top:8rem;
}
.am-btn-primary {
    color: #fff;
    background-color: #dd514c;
    border-color: #dd514c;
}
</style>
<div class="bg">
<h2>关于本站</h2>
<p>必应每日精彩壁纸与故事</p>
</div>
<div class="am-container">
<ul class="am-comments-list am-comments-list-flip">
<?php 
//$info=array_reverse($info);
for($i=count($info)-1;$i>0;$i--){
  $time=$info[$i]['time'];
  $content=$info[$i]['content'];
echo"
<li class=\"am-comment am-comment\">
<a href=\"$webConfig[avaurl]\" target=\"_blank\">
<img src=\"$webConfig[avatar]\" alt=\"\" class=\"am-comment-avatar\" width=\"48\" height=\"48\"/>
</a>
<div class=\"am-comment-main\">
<header class=\"am-comment-hd\">
<div class=\"am-comment-meta\">
<a class=\"am-comment-author\" target=\"_blank\">
$webConfig[nina]
</a>
发布于 
<time datetime=\"$time\" title=\"$time\">
$time
</time>
</div>
</header>
<div class=\"am-comment-bd\">
<p>$content</p>
</div>
</div>
</li>";	
}
?>
</ul>
</div> 
<!-- 容器结束 -->
<?php include('footer.php');?>