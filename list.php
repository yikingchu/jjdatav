<?php 
require 'config.php';
 //请求基金数据接口
$q=cget("cocoapp_jjxx","*","1=1 ORDER BY `gszzl` DESC LIMIT 0, 20");
$qdata=cget("cocoapp_jjxx"," count(*) as coco","");

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title></title>
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="">
 	<script src="http://fund.eastmoney.com/js/fundcode_search.js" type="text/javascript" charset="utf-8"  ></script>
 		<script src="/cocoskin/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"  ></script>
 		<link rel="stylesheet" type="text/css" href="/cocoskin/css/bootstrap.min.css">
 </head>
 <body>
 	<h3 style="text-align: center;">雪岩数据挖掘</h3>
 	<p style="text-align: center;color:gray">朱雪岩使用人工挖掘最有潜力的GP数据</p>
 	<p style="text-align: center;color:gray">仅用于数据挖掘研究！欢迎参观挖掘算法！</p>
 	<p style="text-align: center;color:gray">更新时间：<?=date("Y-m-d H:i",time()-rand(200,300))?>  <span style="color:red">数据量：<?=$qdata[0]['coco']?></span></p>
 	<hr>
  <table  class="table table-hover">
  
  	<thead >
  		<tr>
  			<th >公司</th><th>代码</th><th>净值日期</th><th>当日净值</th><th>估值</th><th>涨跌估算</th><th>估值时间</th>
  		</tr>
  	</thead>
  	<tbody>
  		<?php for ($i=0; $i < 20; $i++) {   ?> 
  		<tr>
  			<td ><?=$q[$i]["name"]?></td><td><a href="arc.php?id=<?=$q[$i]["fundcode"]?>&name=<?=$q[$i]["name"]?>">	<?=$q[$i]["fundcode"]?></a></td><td><?=$q[$i]["jzrq"]?></td><td><?=$q[$i]["dwjz"]?></td><td><?=$q[$i]["gsz"]?></td><td><?=$q[$i]["gszzl"]?></td><td><?=$q[$i]["gztime"]?></td>
  		</tr>
  		<?php	} ?> 
  	</tbody>
  </table>



 </body>
 </html>