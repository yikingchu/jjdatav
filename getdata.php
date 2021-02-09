<?php 
require 'config.php';
 //请求基金数据接口
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title></title>
 	<link rel="stylesheet" href="">
 	<script src="http://fund.eastmoney.com/js/fundcode_search.js" type="text/javascript" charset="utf-8"  ></script>
 		<script src="/cocoskin/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"  ></script>
 		<link rel="stylesheet" type="text/css" href="/cocoskin/css/bootstrap.min.css">
 	<script  type="text/javascript" charset="utf-8"  >
       var j=decodeURI(JSON.stringify(r),"utf-8");
       jQuery.post('apiinsert.php', {
       	m: 1,
       	b:j
       }, function(data,status, xhr) {
        console.log(data);
       });
 	</script>
 </head>
 <body>
  
 </body>
 </html>