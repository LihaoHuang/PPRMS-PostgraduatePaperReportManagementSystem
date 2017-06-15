<?php
$time=date("Y-m-d",time());
$paper_id = $_POST['FileUpload_paper_id'];

$target_dir = "../uploads/";
$target_name = md5($paper_id . '_' . $time);
$target_file = $target_dir . $target_name;
$imageFileType = pathinfo($target_dir . $_FILES["file"]["name"],PATHINFO_EXTENSION);

$dbhost = '140.130.35.62';
$dbport = '8082';
$dbuser = '40343232';
$dbpass = '40343232';
$dbname = '40343232';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport) ;//連接資料庫
mysqli_query($conn,"SET NAMES 'utf8'");//設定語系
$sql = "UPDATE `paper` SET `filename` = '{$_FILES["file"]["name"]}', `filename_store` = '{$target_name}' WHERE `paper_id` = '{$paper_id}'";

if($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "txt" ) {
    $_SESSION['message'] = '只能允許pdf, doc, docx, txt等副檔名!';
    echo $imageFileType;
    echo '<script>window.location.replace("../paper_manage.php");</script>';
    exit();
}

$result = mysqli_query($conn,$sql);
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

session_start();
$_SESSION['message'] = '檔案上傳成功!';
echo '<script>window.location.replace("../paper_manage.php");</script>';

// echo json_encode($data, JSON_UNESCAPED_UNICODE);
// mysqli_close($conn);
?>