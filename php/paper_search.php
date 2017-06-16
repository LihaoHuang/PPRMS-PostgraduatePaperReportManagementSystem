<?php
header('Access-Control-Allow-Origin: *');
error_reporting(E_ALL ^ E_DEPRECATED);
$user_id=$_POST['user_id'];
$category=$_POST['category'];
$keyword=$_POST['keyword'];
$sql_temp="";
if ($category == "keyword"){
    $sql_temp = "`keyword1` = '{$keyword}' OR `keyword2` = '{$keyword}' OR `keyword3` = '{$keyword}' OR `keyword4` = '{$keyword}' OR `keyword5` = '{$keyword}'";
}else{
    $sql_temp = "`$category` = '{$keyword}'";
}

$dbhost = '140.130.35.62';
$dbport = '8082';
$dbuser = '40343232';
$dbpass = '40343232';
$dbname = '40343232';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport) ;//連接資料庫
mysqli_query($conn,"SET NAMES 'utf8'");//設定語系
session_start();
if ($_SESSION["authority"] == 1){
    $sql = "SELECT * FROM `paper` INNER JOIN `user` on `paper`.`user_id` = `user`.`user_id` WHERE {$sql_temp}  ORDER BY paper_id DESC";
}else{
    $sql = "SELECT * FROM `paper` INNER JOIN `user` on `paper`.`user_id` = `user`.`user_id` WHERE `user`.`user_id` = '{$user_id}' AND ({$sql_temp}) ORDER BY paper_id DESC";
}
$result = mysqli_query($conn,$sql);
//echo $sql;
$i=0;
$data = array();
while($row = mysqli_fetch_array($result)){
    $data[$i]['paper_id']		= $row['paper_id'];
    $data[$i]['user_id']		= $row['user_id'];
    $data[$i]['paper_name']		= $row['paper_name'];
    $data[$i]['source']			= $row['source'];
    $data[$i]['publish']		= $row['publish'];
    $data[$i]['report_time']	= $row['report_time'];
    $data[$i]['journal']		= $row['journal'];
    $data[$i]['vol']			= $row['vol'];
    $data[$i]['no']				= $row['no'];
    $data[$i]['seminar_loc']	= $row['seminar_loc'];
    $data[$i]['seminar_time']	= $row['seminar_time'];
    $data[$i]['page']			= $row['page'];
    $data[$i]['filename']		= $row['filename'];
    $data[$i]['pass']			= $row['pass'];
    $data[$i]['upload_time']	= $row['upload_time'];
    $data[$i]['update_time']	= $row['update_time'];
    $data[$i]['teacher']		= $row['teacher'];
    $data[$i]['favorite']		= $row['favorite'];
    //
    $data[$i]['username']	= $row['username'];
    $data[$i]['name']		= $row['name'];
    $data[$i]['school']		= $row['school'];
    $data[$i]['department']	= $row['department'];
    $data[$i]['email']		= $row['email'];
    $data[$i]['authority']	= $row['authority'];
    $data[$i]['valid']		= $row['valid'];
    $data[$i]['SESSION_auth']		= $_SESSION["authority"];
    $i = $i + 1;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);
?>