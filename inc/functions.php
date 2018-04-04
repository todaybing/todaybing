<?
   function getParam($key,$default='')
{
    return trim($key && is_string($key) ? (isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : $default)) : $default);
}

function echoToindex($ms,$nam,$url,$story,$cp,$Continent,$ct,$city,$str){
	         echo"
				<li>
                  <div class='am-gallery-item' title='$ms-$nam'>
                    <img src='$url'  data-rel=\"$url\" alt='$story' />
                      <h3 class='am-gallery-title'>$ms</h3>   
                      <div class='am-gallery-desc'>$cp </br>
					    <span class='am-badge am-radius'>$Continent</span>
					    <span class='am-badge am-radius'>$ct</span>
					    <span class='am-badge am-radius'>$city</span>
					    <button type='button' class='am-dbtn am-btn-primary am-radius am-fr' title=''  onclick=\"downfile('https://resources.lylares.com/bing/download.php?fn=$str');\">
					    <span class='am-icon-cloud-download'></span>
					    立即下载
					    </button>
					  </div>
                    </a>
                  </div>
                </li>
				";
}

//抓取函数
function apiCallback($url){ 
    $ch = curl_init(); 
    $timeout = 30; 
    $ua = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36';
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);   // 伪造ua 
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip'); // 取消gzip压缩
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    $content = trim(curl_exec($ch)); 
    curl_close($ch); 
    return $content; 
}