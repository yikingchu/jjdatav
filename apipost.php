<?php 
require 'config.php';
$rdate=date("Y-m-d");
$q=cget("cocoapp_jjbh","*","");
cdelete("cocoapp_jjxx","createdate='$rdate'");
for ($i=0; $i < sizeof($q); $i++) { 
$n=$q[$i]['num']; //获取基金编号
$url="http://fundgz.1234567.com.cn/js/$n.js";
$dd=file_get_contents($url);
$dc=substr($dd, 8);
$d=preg_replace("/\)\;/"," ",$dc);
$r=json_decode($d,ture);
$r["createtime"]=date("Y-m-d H:i:s");
$r["createdate"]=date("Y-m-d");
cinsert("cocoapp_jjxx",$r);
echo $n."股票/基金请求成功！<br>";
 }
cdelete("cocoapp_jjxx","name is null");

 ?>