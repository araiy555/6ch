<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/javascript; charset=UTF-8");
session_start();
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

try {
    $artcle_id = $_GET['data'];
      	//登録処理する
        if (isset($artcle_id)) {
      	$sql = $pdo->prepare("DELETE FROM posts where id=:artcle_id");
      	$sql->bindValue(':artcle_id', $artcle_id);
      	$sql->execute();
       }else {
           throw new Exception();
       }
} catch (\Exception $e) {
    echo "問題が発生しました。";
}
  exit();
