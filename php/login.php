<?php
$username=$_POST['username'];
$password=$_POST['password'];


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
    	if ($row['password'] == md5($password)) {
            if ($row['valid'] == '0') {
                session_start();
                $_SESSION['message'] = '登入失敗，申請尚未通過!';
                print '<script>window.location.replace("../login.php");</script>';
                exit();
            }
    		session_start();
    		$_SESSION['user_id'] = $row['user_id'];
    		$_SESSION['username'] = $row['username'];
    		$_SESSION['name'] = $row['name'];
    		$_SESSION['school'] = $row['school'];
    		$_SESSION['department'] = $row['department'];
    		$_SESSION['email'] = $row['email'];
    		$_SESSION['authority'] = $row['authority'];
    		$_SESSION['valid'] = $row['valid'];

            $_SESSION['message'] = '登入成功!';
    		print '<script>window.location.replace("../index.php");</script>';
            exit();
    	}else{
            session_start();
            $_SESSION['message'] = '帳號或密碼錯誤，請重新輸入!';
            print '<script>window.location.replace("../login.php");</script>';
            exit();
    	}
    }
}
session_start();
$_SESSION['message'] = '帳號或密碼錯誤，請重新輸入';
print '<script>window.location.replace("../login.php");</script>';

// echo json_encode($data, JSON_UNESCAPED_UNICODE);
// mysqli_close($conn);
?>