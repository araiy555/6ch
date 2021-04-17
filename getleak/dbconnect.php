<?php
//$dsn = "mysql:dbname=mini_bbs;host=localhost;charset=utf8";
//$username = 'root';
//$password = '1234';
//$options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];
//
//mysql_connect('localhost','root','1234') or die(mysql_error());
//mysql_select_db('mini_bbs');
//mysql_query('SET NAMES utf8');
//mysql_set_charset('utf8');
//
//$pdo = new PDO('mysql:dbname=mini_bbs;host=localhost','root','1234');
//$stmt = $pdo->query('SET NAMES utf8');
//$pdo = new PDO('mysql:dbname=mini_bbs;charset=utf8;host=localhost', 'root', '1234', [
//    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // SQL実行に失敗した場合にもPDOExceptionを投げる
//]);
//$dsn='mysql:host=localhost;dbname=mini_bbs';
//?>

<?php
// mysql_connect('localhost','root','1234') or die(mysql_error());
//mysql_select_db('mini_bbs');
//mysql_query('SET NAMES utf8');
//mysql_set_charset('utf8');

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
$dsn='mysql:host=mysql5027.xserver.jp;dbname=earthwork_sample';
?>