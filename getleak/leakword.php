<?php

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

if($_GET['data']){
    $created = date('Y-m-d H:i:s');
    $favorite_id = $_GET['data'];
    //登録処理するINSERT INTO `reakword`(`word`) VALUES ('k')
    $sql = $pdo->prepare("INSERT INTO reakword SET word=:favorite_id,created=:created,modified=:modified");
    $sql->bindValue(':favorite_id', $favorite_id);
    $sql->bindValue(':created', $created);
    $sql->bindValue(':modified',$created);
    $flag = $sql->execute();
}else{
    $favorite_id = 'loginerror';
}
echo $flag;
exit();
