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
$sql = "SELECT * FROM `paper` WHERE `paper_id` = '{$paper_id}'";
$result = mysqli_query($conn,$sql);
$data = array();
$i=0;
while($row = mysqli_fetch_array($result)){
    $data[$i]['paper_name']		= $row['paper_name'];
    $data[$i]['source']			= $row['source'];
    $data[$i]['publish']		= $row['publish'];
    $data[$i]['journal']		= $row['journal'];
    $data[$i]['vol']			= $row['vol'];
    $data[$i]['no']				= $row['no'];
    $data[$i]['page']			= $row['page'];
    $data[$i]['filename']		= $row['filename'];
    $data[$i]['filename_store']	= $row['filename_store'];
}
$file_name = $data[$i]['filename_store'] . ".txt"; //檔案名稱
$fp = @fopen("../uploads/"."$file_name", "w+"); //開啟檔案，要是沒有檔案將建立一份

$content = "";
$content .= "論文名稱：" . $data[$i]['paper_name'] . "\r\n";
$content .= "出處：" . $data[$i]['source'] . "\r\n";
$content .= "發表年份：" . $data[$i]['publish'] . "\r\n";
$content .= "期刊：" . $data[$i]['journal'] . "(第" . $data[$i]['vol'] . "捲 第" . $data[$i]['no'] . "期)\r\n";
$content .= "起訖頁數：" . $data[$i]['page'] . "\r\n";

fwrite($fp, $content);
fclose($fp);

$file = "../uploads/" . $data[$i]['filename_store'] . ".txt"; // 實際檔案的路徑+檔名

$filename = $data[$i]['paper_name'] . ".txt"; //檔案名稱
//指定下載時的檔名
header("Content-Disposition: attachment; filename=".$filename."");

//輸出下載的內容。

readfile($file);

?>
