<?php
session_start();
require('dbconnect.php');
// ログイン状態チェック
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
	$_SESSION['time'] = time();
	$sql=sprintf('SELECT * FROM members WHERE id=%d',
	mysql_real_escape_string($_SESSION['id']));
	$record = mysql_query($sql) or die(mysql_query());
	$member = mysql_fetch_assoc($record);
}else{
	header('Location: login.php');
}

?>


<?php
if ($_FILES["file"]["error"] > 0)
{
    echo "Error: " . $_FILES["file"]["error"] . "<br />";
}
else
{
    $type = $_FILES["file"]["type"];
    $size = $_FILES['file']['size'];
    $tmp=$_FILES["file"]["tmp_name"];
    $fp = fopen($tmp,'rb');
    $data = bin2hex(fread($fp,$size));
    $dsn='mysql:host=localhost;dbname=mini_bbs';
	$member_id = $member['id'];
    echo '<pre>';
    try{
        $pdo = new PDO($dsn,'root','1234');
        $pdo->exec("INSERT INTO `upload`(`type`,`data`,`member_id`) values ('$type',0x$data,'$member_id')");
        $id = $pdo->lastInsertId();
        echo 'upload success!';
        $pdo = null;
    }catch (PDOException $e){
        echo $e->getMessage();
    }
    echo '</pre>';
    fclose($fp);

}