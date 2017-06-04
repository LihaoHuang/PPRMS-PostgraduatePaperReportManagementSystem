<?php
$username=$_POST['username'];
$email=$_POST['email'];
$name=$_POST['name'];
$school=$_POST['school'];
$department=$_POST['department'];
$password=md5($_POST['password']);


$dbhost = '140.130.35.62';
$dbport = '8082';
$dbuser = '40343232';
$dbpass = '40343232';
$dbname = '40343232';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport) ;//連接資料庫
mysqli_query($conn,"SET NAMES 'utf8'");//設定語系
$sql = "SELECT * FROM `user`";
$result = mysqli_query($conn,$sql);

$i=0;
while($row = mysqli_fetch_array($result)){
    if ($row['username'] == $username) {
        session_start();
        $_SESSION['message'] = '帳號申請失敗，帳號已存在!';
        echo '<script>window.location.replace("../login.php");</script>';
        exit();
    }
}
$sql = "INSERT INTO `user` (`username`, `email`, `name`, `school`, `department`, `password`, `valid`) VALUES ('{$username}', '{$email}', '{$name}', '{$school}', '{$department}', '{$password}', 0)";
$result = mysqli_query($conn,$sql);
session_start();
$_SESSION['message'] = '帳號申請成功，請等候管理員開通!';
echo '<script>window.location.replace("../login.php");</script>';

// echo json_encode($data, JSON_UNESCAPED_UNICODE);
// mysqli_close($conn);
?>