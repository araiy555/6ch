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
header('Expires: -1');
header('Cache-Control:');
header('Pragma:');
require('dbconnect.php');

$jibun = $member['id'];


$sql = "SELECT   member_id, user_id, message, created FROM message  WHERE member_id IN ('$jibun')  ORDER BY created DESC;" ;
  $record = mysql_query($sql) or die(mysql_error());
?>






<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
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

	<body class="grey lighten-4">

		<?php  require_once 'nav/nav2.php'; ?>

		  <div class="container">
		<!-- Grid row -->
		<div class="row">
			<!-- Grid column -->
		  <div class="col-md-3">

		 <?php require_once 'navgetion/nav1.php';?>


		 		 </div>

				 <div class="col-md-9">

			<?php
			while($messages = mysql_fetch_assoc($record)):
			?>
		<?php

		require('dbconnect.php');

		$aite = $messages['user_id'];


		$sql = "SELECT id,simei,name,message,kokuseki FROM members WHERE id IN ('$aite');" ;
		  $following = mysql_query($sql) or die(mysql_error());
		?>

			<?php
			while($aki = mysql_fetch_assoc($following)):
			?>

			<?php echo $aki['simei']; ?><?php echo $aki['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $messages['message']; ?><?php echo $messages['created']; ?></br>


		<?php
			endwhile;
			?>
		<?php
			endwhile;
			?>

    </section>

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
