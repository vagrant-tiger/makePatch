$agent = check_wap();
if( $agent )
{
  header('Location: /m/');
  exit;
}
// check if wap 
function check_wap(){
  // 先检查是否为wap代理，准确度高
  if(stristr($_SERVER['HTTP_VIA'],"wap")){
    return true;
  }
  // 检查浏览器是否接受 WML.
  elseif(strpos(strtoupper($_SERVER['HTTP_ACCEPT']),"VND.WAP.WML") > 0){
    return true;
  }
  //检查USER_AGENT
  elseif(preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])){
    return true;       
  }
  else{
    return false;  
  }
}






function isMobile() {
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ( $_SERVER ['HTTP_X_WAP_PROFILE'] )) {
        return true;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ( $_SERVER ['HTTP_VIA'] )) {
        // 找不到为flase,否则为true
        return stristr ( $_SERVER ['HTTP_VIA'], "wap" ) ? true : false;
    }
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ( $_SERVER ['HTTP_USER_AGENT'] )) {
        $clientkeywords = array ('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile' );
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match ( "/(" . implode ( '|', $clientkeywords ) . ")/i", strtolower ( $_SERVER ['HTTP_USER_AGENT'] ) )) {
            return true;
        }
    }
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ( $_SERVER ['HTTP_ACCEPT'] )) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos ( $_SERVER ['HTTP_ACCEPT'], 'vnd.wap.wml' ) !== false) && (strpos ( $_SERVER ['HTTP_ACCEPT'], 'text/html' ) === false || (strpos ( $_SERVER ['HTTP_ACCEPT'], 'vnd.wap.wml' ) < strpos ( $_SERVER ['HTTP_ACCEPT'], 'text/html' )))) {
            return true;
        }
    }
    return false;
}
if (isMobile ()) {
    Header ( "Location: mobile.php" );
    exit ();
}





这是PHP判断手机设备函数代码，复制到PHP函数库中调用:
<?php
function is_mobile() {
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$mobile_browser = Array(
"mqqbrowser", //手机QQ浏览器
"opera mobi", //手机opera
"juc","iuc",//uc浏览器
"fennec","ios","applewebKit/420","applewebkit/525","applewebkit/532","ipad","iphone","ipaq","ipod",
"iemobile", "windows ce",//windows phone
"240×320","480×640","acer","android","anywhereyougo.com","asus","audio","blackberry","blazer","coolpad" ,"dopod", "etouch", "hitachi","htc","huawei", "jbrowser", "lenovo","lg","lg-","lge-","lge", "mobi","moto","nokia","phone","samsung","sony","symbian","tablet","tianyu","wap","xda","xde","zte"
);
$is_mobile = false;
foreach ($mobile_browser as $device) {
if (stristr($user_agent, $device)) {
$is_mobile = true;
break;
}
}
return $is_mobile;
}?>

这是调用代码，可以加上if判断:
<?php if(is_mobile()):?>
设置手机端的内容
<?php endif; ?>