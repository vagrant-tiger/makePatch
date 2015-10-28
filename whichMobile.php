function checkmobile() {
global $_G;
$mobile = array();
static $touchbrowser_list =array('iphone', 'android', 'phone', 'mobile', 'wap', 'netfront', 'java', 'opera mobi', 'opera mini',
'ucweb', 'windows ce', 'symbian', 'series', 'webos', 'sony', 'blackberry', 'dopod', 'nokia', 'samsung',
'palmsource', 'xda', 'pieplus', 'meizu', 'midp', 'cldc', 'motorola', 'foma', 'docomo', 'up.browser',
'up.link', 'blazer', 'helio', 'hosin', 'huawei', 'novarra', 'coolpad', 'webos', 'techfaith', 'palmsource',
'alcatel', 'amoi', 'ktouch', 'nexian', 'ericsson', 'philips', 'sagem', 'wellcom', 'bunjalloo', 'maui', 'smartphone',
'iemobile', 'spice', 'bird', 'zte-', 'longcos', 'pantech', 'gionee', 'portalmmm', 'jig browser', 'hiptop',
'benq', 'haier', '^lct', '320x320', '240x320', '176x220');
static $mobilebrowser_list =array('windows phone');
static $wmlbrowser_list = array('cect', 'compal', 'ctl', 'lg', 'nec', 'tcl', 'alcatel', 'ericsson', 'bird', 'daxian', 'dbtel', 'eastcom',
'pantech', 'dopod', 'philips', 'haier', 'konka', 'kejian', 'lenovo', 'benq', 'mot', 'soutec', 'nokia', 'sagem', 'sgh',
'sed', 'capitel', 'panasonic', 'sonyericsson', 'sharp', 'amoi', 'panda', 'zte');


$pad_list = array('pad', 'gt-p1000');


$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);


if(dstrpos($useragent, $pad_list)) {
return false;
}
if(($v = dstrpos($useragent, $mobilebrowser_list, true))){
$_G['mobile'] = $v;
return '1';
}
if(($v = dstrpos($useragent, $touchbrowser_list, true))){
$_G['mobile'] = $v;
return '2';
}
if(($v = dstrpos($useragent, $wmlbrowser_list))) {
$_G['mobile'] = $v;
return '3'; //wml版
}
$brower = array('mozilla', 'chrome', 'safari', 'opera', 'm3gate', 'winwap', 'openwave', 'myop');
if(dstrpos($useragent, $brower)) return false;


$_G['mobile'] = 'unknown';
if(isset($_G['mobiletpl'][$_GET['mobile']])) {
return true;
} else {
return false;
}
}