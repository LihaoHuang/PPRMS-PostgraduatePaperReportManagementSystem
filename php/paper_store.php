<?php
$paper_id=$_POST['paper_id'];
$paper_name=$_POST['paper_name'];
$source=$_POST['source'];
$publish=$_POST['publish'];
$seminar_loc=$_POST['seminar_loc'];
$seminar_time=$_POST['seminar_time'];
$page=$_POST['page'];
$journal=$_POST['journal'];
$vol=$_POST['vol'];
$no=$_POST['no'];
$keyword1=$_POST['keyword1'];
$keyword2=$_POST['keyword2'];
$keyword3=$_POST['keyword3'];
$keyword4=$_POST['keyword4'];
$keyword5=$_POST['keyword5'];
$teacher=$_POST['teacher'];
$report_time=$_POST['report_time'];
$time=date("Y-m-d",time());

$dbhost = '140.130.35.62';
$dbport = '8082';
$dbuser = '40343232';
$dbpass = '40343232';
$dbname = '40343232';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport) ;//連接資料庫
mysqli_query($conn,"SET NAMES 'utf8'");//設定語系
$sql = "UPDATE `paper` SET `paper_name` = '{$paper_name}', `source` = '{$source}', `publish` = '{$publish}', `seminar_loc` = '{$seminar_loc}', `seminar_time` = '{$seminar_time}', `page` = '{$page}', `journal` = '{$journal}', `vol` = '{$vol}', `no` = '{$no}', `keyword1` = '{$keyword1}', `keyword2` = '{$keyword2}', `keyword3` = '{$keyword3}', `keyword4` = '{$keyword4}', `keyword5` = '{$keyword5}', `teacher` = '{$teacher}', `report_time` = '{$report_time}', `update_time` = '{$time}' WHERE `paper_id` = '{$paper_id}'";
$result = mysqli_query($conn,$sql);

session_start();
$_SESSION['message'] = '更新成功!';
echo '<script>window.location.replace("../paper_manage.php");</script>';

// echo json_encode($data, JSON_UNESCAPED_UNICODE);
// mysqli_close($conn);
?>