<?php 
$id=$_GET['id'];
$name=$_GET['name'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script src="/cocoskin/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"  ></script>
 		<link rel="stylesheet" type="text/css" href="/cocoskin/css/bootstrap.min.css">
	<script type="text/javascript" src="http://fund.eastmoney.com/pingzhongdata/<?=$id?>.js"></script>

</head>
<body>
 
 

	<table class="table table-hover">
		<thead>
			<tr>
				<th><?=$name?></th> <th>编号：<?=$id?></th>
			</tr>
			 
		</thead>
		<tbody>
			<tr>
				<td>近1年收益率</td><td id="f1y"> </td>
			</tr>
			<tr>
				<td>近6月收益率</td><td id="f6m"></td>
			</tr>
			<tr>
				<td>近3月收益率</td><td id="f3m"></td>
			</tr>
				<tr>
				<td>近1月收益率</td><td id="f1m"></td>
			</tr>
		</tbody>
	</table>
	 	<script>
		$("#f1y").html(syl_1n);
		$("#f6m").html(syl_6y);
		$("#f3m").html(syl_3y);
		$("#f1m").html(syl_1y);
	</script>

	
	
</body>
</html>