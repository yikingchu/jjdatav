<?php 
require 'config.php';
if($_POST['m']==1){
	$mjson=$_POST['b'];
	$data=json_decode($mjson,ture);

 	for ($i=0; $i < sizeof($data); $i++) { 

 		 $d["num"]=$data[$i][0];
 		 $d["name"]=$data[$i][2];
 		 $d["pyfname"]=$data[$i][1];
 		 $d["pyname"]=$data[$i][4];
 		 $d["lx"]=$data[$i][3];
 		 $flag=cinsert("cocoapp_jjbh",$d);
 	}
 	if($flag){
 		echo "更新接口成功！";
 	}
}


 ?>