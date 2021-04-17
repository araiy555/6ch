<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/javascript; charset=UTF-8");

session_start();
// mysql_connect('localhost','root','1234') or die(mysql_error());
// mysql_select_db('mini_bbs');
// mysql_query('SET NAMES utf8');
// mysql_set_charset('utf8');
//
// $pdo = new PDO('mysql:dbname=mini_bbs;host=localhost','root','1234');
// $stmt = $pdo->query('SET NAMES utf8');
// $pdo = new PDO('mysql:dbname=mini_bbs;charset=utf8;host=localhost', 'root', '1234', [
//     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // SQL実行に失敗した場合にもPDOExceptionを投げる
// ]);
// $dsn='mysql:host=localhost;dbname=mini_bbs';

mysql_connect('mysql5027.xserver.jp','earthwork_arai','q1w2e3r4') or die(mysql_error());
mysql_select_db('earthwork_sample');
mysql_query('SET NAMES utf8');
mysql_set_charset('utf8');

$dsn = "mysql:dbname=earthwork_sample;host=mysql5027.xserver.jp;charset=utf8";
$username = 'earthwork_arai';
$password = 'q1w2e3r4';
$options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];
$pdo = new PDO('mysql:dbname=earthwork_sample;host=mysql5027.xserver.jp','earthwork_arai','q1w2e3r4');
$stmt = $pdo->query('SET NAMES utf8');

$pdo = new PDO('mysql:dbname=earthwork_sample;charset=utf8;host=mysql5027.xserver.jp', 'earthwork_arai', 'q1w2e3r4', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // SQL実行に失敗した場合にもPDOExceptionを投げる
]);
error_reporting(0);
// ログイン状態チェック
if (isset($_SESSION['id']) && $_SESSION['time'] + 36000 > time()) {
	$_SESSION['time'] = time();
	$sql=sprintf('SELECT * FROM members WHERE id=%d',
	mysql_real_escape_string($_SESSION['id']));
	$record = mysql_query($sql) or die(mysql_query());
	$member = mysql_fetch_assoc($record);
  $user_id = $member['id'];
}

if($user_id){
$hyouka_id = $_GET['data'];
  	//登録処理する
  	$sql = $pdo->prepare("DELETE FROM teihyouka where user_id=:user_id AND hyouka_id=:hyouka_id");
  	$sql->bindValue(':user_id', $user_id);
  	$sql->bindValue(':hyouka_id', $hyouka_id);
  	$flag = $sql->execute();

}else{
    $$hyouka_id = 'loginerror';
}

  echo $$hyouka_id;
  exit();
