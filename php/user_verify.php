<?php
$user_id=$_POST['user_id'];

$dbhost = '140.130.35.62';
$dbport = '8082';
$dbuser = '40343232';
$dbpass = '40343232';
$dbname = '40343232';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport) ;//連接資料庫
mysqli_query($conn,"SET NAMES 'utf8'");//設定語系
$sql = "UPDATE `user` SET `valid` = '1' WHERE `user_id` = '{$user_id}'";


$result = mysqli_query($conn,$sql);

session_start();

$_SESSION['message'] = '已成功審核通過!';

echo '<script>window.location.replace("../user_manage.php");</script>';

// echo json_encode($data, JSON_UNESCAPED_UNICODE);
// mysqli_close($conn);
?>