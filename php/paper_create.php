<?php
$user_id=$_POST['user_id'];
$paper_name=$_POST['paper_name'];
$source=$_POST['source'];
$publish=$_POST['publish'];
$report_time=$_POST['report_time'];
$journal=$_POST['journal'];
$vol=$_POST['vol'];
$no=$_POST['no'];
$seminar_loc=$_POST['seminar_loc'];
$seminar_time=$_POST['seminar_time'];
$page=$_POST['page'];
$keyword1=$_POST['keyword1'];
$keyword2=$_POST['keyword2'];
$keyword3=$_POST['keyword3'];
$keyword4=$_POST['keyword4'];
$keyword5=$_POST['keyword5'];
$teacher=$_POST['teacher'];
$time=date("Y-m-d",time());

$target_dir = "../uploads/";
$target_name = md5($user_id . '_' . $time);
$target_file = $target_dir . $target_name;
$imageFileType = pathinfo($target_dir . $_FILES["file"]["name"],PATHINFO_EXTENSION);

$dbhost = '140.130.35.62';
$dbport = '8082';
$dbuser = '40343232';
$dbpass = '40343232';
$dbname = '40343232';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport) ;//連接資料庫
mysqli_query($conn,"SET NAMES 'utf8'");//設定語系
$sql = "INSERT INTO `paper` 
	(`user_id`, `paper_name`, `source`, `publish`, `report_time`, `journal`,`vol`, `no`, `seminar_loc`, `seminar_time`, `page`, `filename`, `filename_store`, `keyword1`, `keyword2`, `keyword3`, `keyword4`, `keyword5`, `pass`, `upload_time`, `update_time`, `teacher`) 
	VALUES ('{$user_id}', '{$paper_name}', '{$source}', '{$publish}', '{$report_time}', '{$journal}', '{$vol}', '{$no}', '{$seminar_loc}', '{$seminar_time}', '{$page}', '{$_FILES["file"]["name"]}', '{$target_name}', '{$keyword1}', '{$keyword2}', '{$keyword3}', '{$keyword4}', '{$keyword5}', '0', '{$time}', '{$time}', '{$teacher}')";

if($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "txt" ) {
    $_SESSION['message'] = '只能允許pdf, doc, docx, txt等副檔名!';
    echo '<script>window.location.replace("../paper_manage_create.php");</script>';
    exit();
}

$result = mysqli_query($conn,$sql);
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

session_start();
$_SESSION['message'] = '建立成功!';
echo '<script>window.location.replace("../paper_manage.php");</script>';

// echo json_encode($data, JSON_UNESCAPED_UNICODE);
// mysqli_close($conn);
?>