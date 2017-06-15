<?php
header('Access-Control-Allow-Origin: *');
error_reporting(E_ALL ^ E_DEPRECATED);
$user_id=$_POST['user_id'];

$dbhost = '140.130.35.62';
$dbport = '8082';
$dbuser = '40343232';
$dbpass = '40343232';
$dbname = '40343232';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport) ;//連接資料庫
mysqli_query($conn,"SET NAMES 'utf8'");//設定語系

session_start();

if ($_SESSION["authority"] == 1){
    $sql = "SELECT * FROM `user` where `user_id` != '{$user_id}' ";
}else{
    $sql = "";
}
$result = mysqli_query($conn,$sql);

$i=0;
$data = array();
while($row = mysqli_fetch_array($result)){
    $data[$i]['user_id']	= $row['user_id'];
    $data[$i]['username']	= $row['username'];
    $data[$i]['name']		= $row['name'];
    $data[$i]['school']		= $row['school'];
    $data[$i]['department']	= $row['department'];
    $data[$i]['email']		= $row['email'];
    $data[$i]['authority']	= $row['authority'];
    $data[$i]['valid']		= $row['valid'];
    $i = $i + 1;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);
?>