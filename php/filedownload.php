<?php
header('Access-Control-Allow-Origin: *');

error_reporting(E_ALL ^ E_DEPRECATED);
$paper_id=$_GET['paper_id'];

$dbhost = '140.130.35.62';
$dbport = '8082';
$dbuser = '40343232';
$dbpass = '40343232';
$dbname = '40343232';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport) ;//連接資料庫
mysqli_query($conn,"SET NAMES 'utf8'");//設定語系
$sql = "SELECT `filename`, `filename_store` FROM `paper` WHERE `paper_id` = '{$paper_id}'";
$result = mysqli_query($conn,$sql);
$data = array();
$i=0;
while($row = mysqli_fetch_array($result)){
    $data[$i]['filename']		= $row['filename'];
    $data[$i]['filename_store']	= $row['filename_store'];
}
$file="../uploads/".$data[0]['filename_store']; // 實際檔案的路徑+檔名

$filename=$data[$i]['filename']; // 下載的檔名
echo $filename;
//指定下載時的檔名
header("Content-Disposition: attachment; filename=".$filename."");

//輸出下載的內容。

readfile($file);

?>
