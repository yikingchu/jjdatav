<?php 
function conn(){
	header("Content-type: text/html; charset=utf-8");
	$servername = "";
	$username = "";
	$password = "";
	$dbname = "";
	 
	// 创建连接
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// 检测连接
	if ($conn->connect_error) {
	    die("连接失败: " . $conn->connect_error);
	} 
	$conn->query("set names utf8");
	return $conn;
}
$conn=conn();
 

function http_post_json($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
        )
    );
 
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return array($httpCode, $response);
}


function cocosendsms($tel,$content){
    $smsinfo=cget($tablename="z_setting_sms",$fileds="*",$where="");
    $statusStr = array(
    "0" => "短信发送成功",
    "-1" => "参数不全",
    "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
    "30" => "密码错误",
    "40" => "账号不存在",
    "41" => "余额不足",
    "42" => "帐户已过期",
    "43" => "IP地址限制",
    "50" => "内容含有敏感词"
    );
    $smsapi = "http://api.smsbao.com/";  //注册地址，请到： http://www.smsbao.com/reg?r=11601 该链接申请新注册号有优惠
    $user = $smsinfo[0]["smsusername"]; //短信平台帐号
    $pass = md5($smsinfo[0]["smspassword"]); //短信平台密码 md5("")
    $content=$content;//要发送的短信内容
    $phone = $tel;//要发送短信的手机号码
    $sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
    $result =file_get_contents($sendurl) ;
return $statusStr[$result];
 }


  function cget($tablename,$fileds,$where){
        global $conn;
        if($where==NULL||$where==""){
        $qsql="SELECT $fileds FROM `$tablename`";
        }else{
          $qsql="SELECT $fileds FROM `$tablename` where $where"; 
        } 
       // echo $qsql;

        $qEof=$conn->query($qsql);
        if($qEof->num_rows>0){ //优化有值的情况下再进行数据你懂的
        $i=0;
        while($qq=$qEof->fetch_assoc()){
            $q[$i]=$qq;
            $i++;
        }
        return $q;
        }
    }//查询数据库
  function cinsert($tablename,$arr){
        global $conn;
        $i=0;
        foreach ($arr as $key => $value){
            $ckey[$i]=$key;
            $cvalue[$i]=$value;
            $i++;
        }
        $ct="";
        $cb="";
        for($j=0;$j<$i;$j++){
            if($j+1==$i){
                $ct.="`".$ckey[$j]."`";
            }else{
                $ct.="`".$ckey[$j]."`,";
            }
        }
         for($j=0;$j<$i;$j++){
         if($j+1==$i){
                $cb.="'".$cvalue[$j]."'";
            }else{
                $cb.="'".$cvalue[$j]."',";
            }
        }
        $isql="INSERT INTO `$tablename` ($ct) VALUES ($cb)";
    echo $isql;
        if($conn->query($isql)){
            return 1; //插入成功
        }else{
            return 0; //插入失败
        }
    } //插入数据库
  function cupdate($tablename,$arr,$where){
         global $conn;
        $cub="";
        $i=0;
        foreach ($arr as $key => $value){
          if($i+1==sizeof($arr)){
              $cub.="`$key`='$value'";
          }else{
              $cub.="`$key`='$value',";
          }
          $i++;
        }
        $usql="UPDATE `$tablename` SET $cub WHERE $where";
  
         if($conn->query($usql)){
            return 1; //更新成功
        }else{
            return 0; //更新失败
        }
    } //更新数据库
  function cdelete($tablename,$where){
        global $conn;
        $dsql="DELETE FROM `$tablename` WHERE $where";
        // echo $dsql;
        if($conn->query($dsql)){
            return 1; //删除成功
        }else{
            return 0; //删除失败
        }
        
    } //删除数据库
    
    
    function toexcel($arr=[0=>[0=>'value',],],$excelname){
    // $arr为无组名数组
    //输出的文件类型为excel  
    header("Content-type:application/vnd.ms-excel");  
    //提示下载  
    header("Content-Disposition:attachement;filename=".$excelname.".xls");  
    //报表数据  
    $ReportArr = $arr;  
    $ReportContent = '';  
    $num1 = count($ReportArr);  
    for($i=0;$i<$num1;$i++){  
        $num2 = count($ReportArr[$i]);  
        for($j=0;$j<$num2;$j++){  
            //ecxel都是一格一格的，用\t将每一行的数据连接起来  
            $ReportContent .= '"'.(string)$ReportArr[$i][$j].'"'."\t";  
        }  
        //最后连接\n 表示换行  
        $ReportContent .= "\n";  
    }  
    //用的utf-8 最后转换一个编码为gb  
    // $ReportContent = mb_convert_encoding($ReportContent,"gb2312","utf-8");  
    //输出即提示下载  
    echo $ReportContent;  
    }


    function upfile($cfile){ //$cfile为前端post时的表单名称 以及form需增加enctype="multipart/form-data"
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES[$cfile]["name"]);
    $extension = end($temp);     // 获取文件后缀名
    if ((($_FILES[$cfile]["type"] == "image/gif")
|| ($_FILES[$cfile]["type"] == "image/jpeg")
|| ($_FILES[$cfile]["type"] == "image/jpg")
|| ($_FILES[$cfile]["type"] == "image/pjpeg")
|| ($_FILES[$cfile]["type"] == "image/x-png")
|| ($_FILES[$cfile]["type"] == "image/png"))
&& ($_FILES[$cfile]["size"] < 10485760)   // 小于 200 kb
&& in_array($extension, $allowedExts))
{
      
    if ($_FILES[$cfile]["error"] > 0)
    {
         
    }
    else
    {
        if (file_exists("/cocoapp/file/" . $_FILES[$cfile]["name"]))
        {
            echo $_FILES[$cfile]["name"] . " 文件已经存在。 ";
        }
        else
        {
            $cocofilein=time().rand(999,10000).".".str_replace("image/", "",$_FILES[$cfile]["type"]);
             move_uploaded_file($_FILES[$cfile]["tmp_name"], "D:/wwwroot/c.sanvm.com/cocoapp/file/" . $cocofilein);
            $cocofile= "/cocoapp/file/".$cocofilein;
        }
    }
    return  $cocofile;
}
    }

function secToTime($times){  //times为时间轴减后的值
        $result = '00:00:00';  
        if ($times>0) {  
                $hour = floor($times/3600);  
                $minute = floor(($times-3600 * $hour)/60);  
                $second = floor((($times-3600 * $hour) - 60 * $minute) % 60);  
                $result = $hour.':'.$minute.':'.$second;  
        }  
        return $result;  
}  


?>