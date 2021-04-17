<?php
require('dbconnect.php');
error_reporting(0);
header('Expires: -1');
header('Cache-Control:');
header('Pragma:');

$db_conf = include_once 'config.php';
/**
* ページング機能サンプル
*/
// エラーを表示してデバッグできるようにする
//ini_set('display_errors');
error_reporting(E_ALL);

/**
* エスケープ
* @param string $str
* @return string
*/
function h($str)
{
return htmlspecialchars($str, ENT_QUOTES, 'utf-8');
}

/**
* 現在のページ番号を取得する
* @return int
*/
function getCurrentPage()
{
return (int) filter_input(INPUT_GET, 'page');
}

/**
* ページャーを組み立てる
* @return string
*/
function pagination($rec)
{
$count = $rec['recordCount'];
$limit = 20;

//レコード総数がゼロのときは何も出力しない
if (0 === $count) {
return '';
}

//現在表示中のページ番号（ゼロスタート）
$intCurrentPage = getCurrentPage();

//ページの最大数
$intMaxpage = ceil($count / $limit);

//現在ページの前後３ページを出力
$intStartpage = (2 < $intCurrentPage) ? $intCurrentPage - 3 : 0;
$intEndpage = (($intStartpage + 7) < $intMaxpage) ? $intStartpage + 7 : $intMaxpage;

//url組み立て
$urlparams = filter_input_array(INPUT_GET);

$items = [];

//最初
$urlparams['page'] = 0;
$items[] = sprintf(
'<span><a class="page-link"tabindex="-1" aria-disabled="true" href="?%s">%s</a></span>',
http_build_query($urlparams),
'<li class="page-item">最初</li>'
);

//表示中のページが先頭ではない時
if (0 < $intCurrentPage) {
$urlparams['page'] = $intCurrentPage - 1;
$items[] = sprintf(
'<span><a class="page-link"tabindex="-1" aria-disabled="true" ref="?%s">%s</a></span>',
http_build_query($urlparams),
'<li class="page-item">前へ</li>'
);
}

for ($i = $intStartpage; $i < $intEndpage; $i++) {
$urlparams['page'] = $i;
$items[] = sprintf(
'<span%s><a class="page-link"tabindex="-1" aria-disabled="true" href="?%s">%s</a></span>',
($intCurrentPage == $i) ? ' class="current"' : '',
http_build_query($urlparams),
$i + 1
);
}

//表示中のページが最後ではない時
if ($intCurrentPage < $intMaxpage) {
$urlparams['page'] = $intCurrentPage + 1;
$items[] = sprintf(
'<span><a class="page-link"tabindex="-1" aria-disabled="true" href="?%s">%s</a></span>',
http_build_query($urlparams),
'<li class="page-item">次へ</li>'
);
}

//最後
$urlparams['page'] = $intMaxpage - 1;
$items[] = sprintf(
'<span><a class="page-link"tabindex="-1" aria-disabled="true" href="?%s">%s</a></span>',
http_build_query($urlparams),
'  <li class="page-item">最後</li>
'
);

return sprintf(' <ul class="pagination justify-content-center"><div class="pagination">%s</div> </ul>', implode(PHP_EOL, $items));
}

/**
* データベースに接続する
* @return \PDO
* @throws Exception
*/
function connect()
{
try {
$dsn = "mysql:dbname=mini_bbs;host=localhost;charset=utf8";
$username = 'root';
$password = '1234';
$options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

$dbh = new PDO($dsn, $username, $password, $options);
return $dbh;
} catch (PDOException $e) {
throw new Exception('データベース接続に失敗しました。', $e->getCode(), $e);
}
}

/**
* レコードセットを取得する
* @param string $sql
* @param array $params
* @param array $order
* @param int $limit
* @return array
*/
function select($sql, array $params = null, array $order = null, $limit = null)
{
$statement = $sql;
if (!is_null($order)) {
$orderToken = [];
foreach ($order as $field => $value) {
$orderToken[] = sprintf('%s %s', $field, $value);
}
$orderStr = implode(', ', $orderToken);
$statement .= " ORDER BY {$orderStr}";
}

$dbh = connect();

try {
// ここからちょっと手抜きw
// 本来は SELECT count(*) FROM ... で全レコード数をとるべき
$stmt = $dbh->prepare($statement);
$stmt->execute($params);
$recset = $stmt->fetchAll(PDO::FETCH_ASSOC);
$recCount = count($recset);

// LIMITが設定されているとき
if (!is_null($limit)) {
$start = getCurrentPage() * $limit;
$statement .= sprintf(' LIMIT %d, %d', $start, $limit);
$stmt = $dbh->prepare($statement);
$stmt->execute($params);
$recset = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

return ['recordSet' => $recset, 'recordCount' => $recCount];
} catch (PDOException $e) {
throw new Exception('データベース・エラーが発生しました。', $e->getCode(), $e);
}
}

try {
session_start();


error_reporting(0);
if ($_REQUEST['search']) {
$value = $_REQUEST['search'];
$sql = "SELECT id, simei,name,job,tosi,kokuseki,message,seibetu FROM members WHERE simei='$value'" ;
} else {
$sql = "SELECT id, simei,name,job,tosi,kokuseki,message,seibetu FROM members " ;
}
//$sql = 'SELECT id, name, field FROM table WHERE field = :value';
$params = [':value' => '○○○○'];

// ORDER句
$order = ['created' => 'DESC'];

// 1ページに表示するレコード数
$limit = 20;

//  レコードセットを取得
$res = select($sql, $params, $order, $limit);
} catch (Exception $e) {
$err = $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<meta name="description" content="EARTHは、同じ職業の人たちと交流を深めることのできるソーシャルユーティリティサイトです。EARTHを利用すれば、同じ職業の人と質問し合い最新の情報をチェックしたり、写真をアップロードしたり(枚数は無制限)、リンクや動画を投稿したり、新たな可能性を.">
<title>EARTH</title>
<link rel="shortcut icon" href="img/favicon1.ico" type="image/x-icon">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="css/mdb.min.css" rel="stylesheet">
<!-- Your custom styles (optional) -->
<link href="css/style.min.css" rel="stylesheet">




<style>
#loader-bg {
background: #fff;
height: 100%;
width: 100%;
position: fixed;
top: 0px;
left: 0px;
z-index: 10;
}
#loader-bg img {
background: #fff;
position: fixed;
top: 50%;
left: 50%;
-webkit-transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
transform: translate(-50%, -50%);
z-index: 10;
}
.scroll-nav {
/* スクロールバーを見えなくするため */
height: 48px; /* 実際に表示する高さ */
overflow-y: hidden;
}

/* 中身がスクロールするビュー */
.scroll-nav__view {
-webkit-overflow-scrolling: touch;
overflow-x: scroll;
}

/* 実際にスクロールするオブジェクト */
.scroll-nav__list {
/* tableにすることで、横幅指定をすることなくmargin: autoによる中央寄せが可能になる */
display: table;
list-style: none;
margin: 0 auto;
/* 下方向に余分なpadding部分を持たせ、そこにスクロールバーが表示される */
padding: 0 0 24px 0;
}

.scroll-nav__item {
/* itemを横並びに、かつ親要素がその親要素の横幅からはみだすことが可能になる */
display: table-cell;

}

.scroll-nav a {
display: block;
padding: 12px;
/* 文字列の自動改行を禁止 */
white-space: nowrap;
}

/* 以下サンプル用デザイン */

.scroll-nav {
background: #fff;
border-radius:20px;

}

.scroll-nav a {
color: #fff;
font-family: sans-serif;
font-size: 14px;
/* 行高が24pxになるように調整 24/14 */
line-height: 1.71428;
text-decoration: none;
}

/* パソコンではタイル型で表示 */
.slide-wrap {
background-color: #fff;
display: flex;
margin: 0 auto;
max-width: 1080px;
width: 100%;
}
.slide-box {
height: auto;
margin-right: 1%;
width: 24%;
}
/* サムネイルとタイトルのスタイル調整 */
.slide-box a {
background-color: #fff;
color: #222;
display: block;
text-decoration: none;
}
.slide-box img {
display: block;
height: auto;
width: 100%;
}
.slide-box p {
font-weight: bold;
padding: 10px;
}
@media screen and (max-width: 479px) {
/* スマホではスライダーで表示 */
.slide-wrap {
overflow-x: scroll;
-webkit-overflow-scrolling: touch;
overflow-scrolling: touch;
}
.slide-box {
flex: 0 0 70%;
}
}
body {
font-family: Helvetica, Arial, ;
font-size: 12px;

}

</style>

<div id="loader-bg">
<img src="img/ajax-loader (4).gif">
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
jQuery(window).on("load", function() {
jQuery('#loader-bg').hide();
});
</script>





</head>

<body>

<script language="JavaScript">
<!--
function Check(){
if(document.sati.search.value==""){
alert("コメントを入力してください。");
return	false;
}

return	true;
}
//	-->
</script>
<script language="JavaScript">
<!--
function Check2(){
if(document.satim.search.value==""){
alert("コメントを入力してください。");
return	false;
}

return	true;
}
//	-->
</script>

<nav class="navbar  navbar-expand-lg justify-content-center navbar-light scrolling-nav bg-white">
<!-- Navbar brand -->

<a class="navbar-brand" href="taitol.php">
<img alt="" src="img/EARTH4.png" width="100" height="30" class="img-fluid flex-center" ></a>
<!-- Collapse button -->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<!-- Collapsible content -->
<div class="collapse navbar-collapse" id="basicExampleNav">

<div class=" d-block d-sm-none">
<ul class="navbar-nav mr-auto">

<li class="nav-item ">
<a class="nav-link" href="touroku.php">新規登録</a>
</li>
<li class="nav-item ">
<a class="nav-link" href="login.php">ログイン</a>
</li>

</ul>
</div>
<div class="col-md-4">
<script type="text/javascript">
function sample() {
var browser = document.fm.s.value;
location.href = browser;
}
</script>
<div class=" d-none d-sm-block">
<form name="fm">
<select class="browser-default custom-select" name="s" onchange="sample()">
<option value="">---フィルターを選択---</option>
<option value="taitol.login.php?New">すべて</option>
<option value="taitol.login.php?populer=1">人気</option>
<option value="taitol.login.php?climax=1">盛り上がり</option>

</select>
</form>
</div>

</div>

<div class="col-md-8">
<div class=" d-none d-sm-block">
<form action="jinbutu.top.php" method="GET" name="sati"  width="100" height="30"onsubmit="return Check()">
<input type="text" class="form-control" id="keyword"name="search" value="" placeholder="Earthの検索またはチャンネル">
</form>
</div>
</div>

</div>


<ul class="navbar-nav nav-flex-icons">
<li class="nav-item">
<a class="nav-link" href="taitol.login.php?populer=1" data-toggle="tooltip" title="人気"><i class="fa fa-line-chart" aria-hidden="true"></i></a>
</li>
<li class="nav-item">
<a class="nav-link" href="taitol.login.php?climax=1" data-toggle="tooltip" title="盛り上がり"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>
</li>
<li class="nav-item">
<a class="nav-link" href="taitol.login.php?New"data-toggle="tooltip" title="最新"><i class="fa fa-address-card" aria-hidden="true"></i></a>
</li>
<!--<li class="nav-item">
<a class="nav-link" href="taitol.login.php?New"><i class="fa fa-commenting" aria-hidden="true"></i></a>
</li>
<li class="nav-item">
<a class="nav-link" href="taitol.login.php?New"><i class="fa fa-envelope" aria-hidden="true"></i></a>
</li>
<li class="nav-item">

<a class="nav-link" href="user/user.php" data-toggle="tooltip" title="投稿"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

</li>-->
</ul>


<div class=" d-none d-sm-block" >
<ul class="navbar-nav mr-auto">

<li class="nav-item ">
<a class="nav-link" href="touroku.php">新規登録</a>
</li>
<li class="nav-item ">
<a class="nav-link" href="login.php">ログイン</a>
</li>

</ul>

</div>
<div class=" d-none d-sm-block" >

<div class="col-xs-12">
<select class="browser-default custom-select">
<option value="1">日本</option>

</select>
</div>
</div>
</div>

</nav>

<!--Navbar-->
<div class=" d-block d-sm-none">
<nav class="navbar  navbar-expand-lg  navbar-light scrolling-nav bg-white">
<div class="col-md-12 mb-12">
<form action="" method="GET" name="satim" onsubmit="return Check2()">
<input type="text" class="form-control" id="keyword"name="search" value="" placeholder="Earthの検索またはチャンネル">
</form>
</div>
</nav>

</div>


<nav class="navbar  navbar-expand-lg justify-content-center navbar-light scrolling-nav bg-white">

<!-- Collapsible content -->
<div class="collapse navbar-collapse" id="basicExampleNav">

<!-- Links -->
<ul class="navbar-nav mr-auto">


<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
aria-expanded="false">設定</a>
<div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item" href="/EARTH/menu/demo/person/Configuration/Configuration.person.php">検索設定</a>
<a class="dropdown-item" href="/EARTH/menu/demo/language/language.php">言語（language）</a>
</div>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
aria-expanded="false">性別</a>
<div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item" value="男性" href="/EARTH/menu/demo/person/person.php?sex=男性">男性</a>
<a class="dropdown-item" value="女性" href="/EARTH/menu/demo/person/person.php?sex=女性">女性</a>

</div>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
aria-expanded="false">国籍</a>
<div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
<?php   for ($i = 1; ; $i++) {
if ($i > 16) {
break;
} ?>
<a class="dropdown-item"  href="/EARTH/menu/demo/person/person.php?value=<?php echo $db_conf[$i]; ?>"> <?php echo $db_conf[$i]; ?></a>
<?php
}?>

</div>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
aria-expanded="false">仕事</a>
<div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">

<?php   for ($i = 100; ; $i++) {
if ($i > 128) {
break;
} ?>
<a class="dropdown-item" value="IT" href="/EARTH/menu/demo/person/person.php?job=<?php echo $db_conf[$i]; ?>"><?php echo $db_conf[$i]; ?></a>
<?php
}?>
</div>
</li>
<li class="nav-item dropdown">

<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">年齢</a>
<div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item" value="IT" href="/EARTH/menu/demo/person/person.php?age=0>=20">20歳未満</a>
<a class="dropdown-item" value="IT" href="/EARTH/menu/demo/person/person.php?age=20=<29">20-29歳</a>
<a class="dropdown-item" value="IT" href="/EARTH/menu/demo/person/person.php?age=30=<39">30-39歳</a>
<a class="dropdown-item" value="IT" href="/EARTH/menu/demo/person/person.php?age=40=<49">40-49歳</a>
<a class="dropdown-item" value="IT" href="/EARTH/menu/demo/person/person.php?age=50=<59">50-59歳</a>
<a class="dropdown-item" value="IT" href="/EARTH/menu/demo/person/person.php?age=60=<69">60-69歳</a>
<a class="dropdown-item" value="IT" href="/EARTH/menu/demo/person/person.php?age=70=<79">70-79歳</a>
<a class="dropdown-item" value="IT" href="/EARTH/menu/demo/person/person.php?age=80=<100">80歳以上</a>

</div>
</li>


</ul>

</nav>



</div>

<div class="container-fluid">

<?php if (isset($err)) : ?>
<p><?= h($err); ?></p>
<?php else : ?>

<?php if (0 < count($res['recordCount'])) : ?>


<p><?= h(number_format($res['recordCount'])); ?> 件のデ-タが見つかりました。</p>
<!-- Section: Team v.1 -->
<section class="team-section text-center my-5">
<!-- Grid row -->
<div class="row">
<?php foreach ($res['recordSet'] as $record): ?>


<?php

try {
$id = h($record['id']);
$images = $pdo->query("select * from profile where member_id='$id' ORDER BY modified DESC LIMIT 1");
} catch (PDOException $e) {
// 500 Internal Server Errorでテキストとしてエラーメッセージを表示
http_response_code(500);
header('Content-Type: text/plain; charset=UTF-8', true, 500);
exit($e->getMessage());
}


?>
<?php
$id =  h($record['id']);
$sql = "select member_id from profile where member_id='$id' ORDER BY modified DESC LIMIT 1" ;
$arai = mysql_query($sql) or die(mysql_error());
?>

<div class="col-lg-3 col-md-6 mb-lg-0 mb-5">
<div class="avatar mx-auto">

<?php
$kml = mysql_num_rows($arai);

if ($kml == 0) {
echo "<img src='img/noimage.png' width='50%' height='10%' class='rounded-circle z-depth-1'>";
} else {
}
?>

<?php if (!empty($images)): ?>

<?php foreach ($images as $i => $img): ?>
<?php if ($i): ?>
<hr />
<?php endif; ?>


<img src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>"width="50%" height="10%"   class="rounded-circle z-depth-1"alt="画像<?=$i+1?>">


<?php endforeach; ?>

<?php endif; ?>
<h5 class="font-weight-bold mt-4 mb-3">	 <a href="searth.user.main.kiji.php?id=<?= h($record['id']); ?>"><?= h($record['simei']); ?><?= h($record['name']); ?></a>


<?php
 if (h($record['kokuseki']) == '日本') {
     echo  $db_conf['50'];
 }
 if (h($record['kokuseki']) == 'カナダ') {
     echo  $db_conf['51'];
 }
 if (h($record['kokuseki']) == 'グリーンアイランド') {
     echo  $db_conf['52'];
 }
 if (h($record['kokuseki']) == 'プエリトリコ') {
     echo  $db_conf['53'];
 }
 if (h($record['kokuseki']) == 'アイスランド') {
     echo  $db_conf['54'];
 }
 if (h($record['kokuseki']) == 'イタリア') {
     echo  $db_conf['55'];
 }
 if (h($record['kokuseki']) == 'ウクライナ') {
     echo  $db_conf['56'];
 }
 if (h($record['kokuseki']) == 'ウズペキスタン') {
     echo  $db_conf['57'];
 }
 if (h($record['kokuseki'])  == 'イギリス') {
     echo  $db_conf['58'];
 }
 if (h($record['kokuseki'])  == 'オーストラリア') {
     echo  $db_conf['59'];
 }
 if (h($record['kokuseki']) == 'オランダ') {
     echo  $db_conf['60'];
 }
 if (h($record['kokuseki']) == 'ギリシャ') {
     echo  $db_conf['61'];
 }
 if (h($record['kokuseki']) == 'スイス') {
     echo  $db_conf['62'];
 }
 if (h($record['kokuseki']) == 'スウェーデン') {
     echo  $db_conf['63'];
 }
 if (h($record['kokuseki']) == '韓国') {
     echo  $db_conf['64'];
 }
 if (h($record['kokuseki']) == '中国') {
     echo  $db_conf['65'];
 }
?>
</h5>
<p class="text-uppercase blue-text"><strong><?= h($record['job']) ?></strong></p>


<div class="orange-text">
<i class="fa fa-star"> </i>
<i class="fa fa-star"> </i>
<i class="fa fa-star"> </i>
<i class="fa fa-star"> </i>
<i class="fa fa-star"> </i>
</div>
<a href="searth.user.main.kiji.php?id=<?=h($record['id'])?>" class="btn btn-primary btn-md">プロフィール</a>

</div>
</div>

<?php endforeach; ?>
</div>
</section>

<?php else : ?>

<p>検索条件にヒットするデータが見つかりませんでした。</p>

<?php endif; ?>


<nav aria-label="...">
<ul class="pager">
<?= pagination($res); ?>

</ul>
</nav>


<?php endif; ?>


</div>


<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>
