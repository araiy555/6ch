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

if (!isset($_SESSION['join'])){
	header('Location: date.php');
}


$org_timezone = date_default_timezone_get();
date_default_timezone_set('Asia/Tokyo');

$id = $member['id'];
$message = $_SESSION['join']['message'];
$url = $_SESSION['join']['url'];
$renrakubango = $_SESSION['join']['renrakubango'];
$renrakuadoresu = $_SESSION['join']['renrakuadoresu'];

$syokureki = $_SESSION['join']['syokureki'];
$tosi = $_SESSION['join']['tosi'];
$job = $_SESSION['join']['job'];
$detahenkou = date('Y-m-d H:i:s');

if (!empty($_POST)){
	//登録処理する
	$sql = $pdo->prepare("UPDATE members SET message=:message, url=:url, renrakubango=:renrakubango, renrakuadoresu=:renrakuadoresu,detahenkou=:detahenkou,syokureki=:syokureki,job=:job,tosi=:tosi WHERE id=:id ");
	$sql->bindValue(':id', $id);
	$sql->bindValue(':message', $message);
	$sql->bindValue(':url', $url);
	$sql->bindValue(':renrakubango', $renrakubango);
	$sql->bindValue(':renrakuadoresu', $renrakuadoresu);
	$sql->bindValue(':detahenkou', $detahenkou);
	$sql->bindValue(':syokureki', $syokureki);
	$sql->bindValue(':tosi', $tosi);
	$sql->bindValue(':job', $job);
	$flag = $sql->execute();
	header('Location: date.touroku.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
  <?php  require_once 'HTML/fabikon.php'; ?>

	<meta name="description" content="EARTHは、同じ職業の人たちと交流を深めることのできるソーシャルユーティリティサイトです。EARTHを利用すれば、同じ職業の人と質問し合い最新の情報をチェックしたり、写真をアップロードしたり(枚数は無制限)、リンクや動画を投稿したり、新たな可能性を.">
	<title>EARTH</title>
	<link rel="shortcut icon" href="img/favicon1.ico" type="image/x-icon">
<meta charset="utf-8">
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

</head>
<style media="screen">
body {
   font-family: Helvetica, Arial, ;
   font-size: 12px;

}
/*検索ボックス*/
#keyword{
background:#eee;/*検索ボックスの背景カラー*/
}
</style>
<?php $db_conf = include_once 'config.php';?>

<body class="grey lighten-4">
          <?php require 'navgetion/nav4.php';?>
	  <div class="container">
	<!-- Grid row -->
	<div class="row">
		<div class="col-md-12">

		<form action="" method="post">
		<input type="hidden" name="action" value="submit"/>
		<br>
		<div class="card ">
				<div class="card-header">自己紹介</div>
				<div class="card-body">

						<p class="card-text">

									<?php echo htmlspecialchars($_SESSION['join']['message'],ENT_QUOTES,'UTF-8'); ?>
		</p>
				</div>
				</div>
				<br>
				<div class="card ">
						<div class="card-header">ＵＲＬ</div>
						<div class="card-body">

								<p class="card-text">

											<?php echo htmlspecialchars($_SESSION['join']['url'],ENT_QUOTES,'UTF-8'); ?>
				</p>
						</div>
						</div>
						<br>
						<div class="card ">
								<div class="card-header">電話番号</div>
								<div class="card-body">

										<p class="card-text">

											<?php echo htmlspecialchars($_SESSION['join']['renrakubango'],ENT_QUOTES,'UTF-8'); ?>
						</p>
								</div>
								</div>
								<br>
								<div class="card ">
										<div class="card-header">メールアドレス</div>
										<div class="card-body">

												<p class="card-text">

															<?php echo htmlspecialchars($_SESSION['join']['renrakuadoresu'],ENT_QUOTES,'UTF-8'); ?>
								</p>
										</div>
										</div>
										<br>
										<div class="card ">
												<div class="card-header">職業</div>
												<div class="card-body">

														<p class="card-text">
																	<?php echo htmlspecialchars($_SESSION['join']['job'],ENT_QUOTES,'UTF-8'); ?>
										</p>
												</div>
												</div>
												<br>
												<div class="card ">
														<div class="card-header">職歴</div>
														<div class="card-body">

																<p class="card-text">	<?php echo htmlspecialchars($_SESSION['join']['syokureki'],ENT_QUOTES,'UTF-8'); ?>
												</p>
														</div>
														</div>
														<br>
														<div class="card ">
																<div class="card-header">年齢</div>
																<div class="card-body">

																		<p class="card-text"><?php echo htmlspecialchars($_SESSION['join']['tosi'],ENT_QUOTES,'UTF-8'); ?>

														</p>
																</div>
																</div>

<br>
			<a href="date.php?action=rewrite"><button type="button" class="btn btn-default">書き直す</button></a>

		<button type="submit" class="btn btn-primary">登録する</button>

  </div>


	</div>
	</div>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="js/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="js/mdb.min.js"></script>

</body>
</html>
