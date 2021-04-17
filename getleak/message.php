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
	header('Location: searth.login.php');
}
?>


<?php
if(empty($_REQUEST['yousuke'])){
header('Location: searth.login.php');
}

 $sql = sprintf("SELECT m.*, p.* FROM members m, posts p WHERE m.id=%d",
    mysql_real_escape_string($_SESSION['yousuke'])
);
  $posts = mysql_query($sql) or die(mysql_error());
  $post = mysql_fetch_assoc($posts);

?>
<?php
header('Expires: -1');
header('Cache-Control:');
header('Pragma:');
require('dbconnect.php');
error_reporting(0);
$jibun = $member['id'];
$aite = $_SESSION['yousuke'];


$sql = "SELECT  simei, name, member_id, user_id, message, created FROM message  WHERE member_id IN ('$jibun','$aite') AND user_id IN ('$aite') ORDER BY created ASC" ;
  $record = mysql_query($sql) or die(mysql_error());
?>



<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Earth</title>
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
  <body>

			<body class="grey lighten-4">
				<?php  require_once 'nav/nav1.php'; ?>

			<!--/.Navbar-->
			</br>




<form action="" method="post" anctype="multipart/form-data">

<?php

	if(!empty($_POST)){
	//エラー項目の確認

	if($_POST['message'] == ''){
	$error['message'] = 'blank';
	}

	if(empty($error)){
	$_SESSION['join'] = $_POST;
	$_SESSION['aiueo'] = $_SESSION['yousuke'];
	header("Location: message.kakunin.php");
	}
}		//書き直しコード



?>


	  <div class="container">
	<!-- Grid row -->
	<div class="row">

	    <!-- Grid column -->
	    <div class="col-md-3">
	      <nav class="nav flex-column lighten-4 py-4 font-weight-bold ">
	    <a class="list-group-item list-group-item-action waves-effect" href="searth.user.following.php?id=<?php echo $_REQUEST['id'];?>">データ</a>
			<a class="list-group-item list-group-item-action waves-effect" href="searth.user.main.kiji.php?id=<?php echo $_REQUEST['id'];?>">記事</a>
			<a class="list-group-item list-group-item-action waves-effect" href="searth.user.main.gazou.php?id=<?php echo $_REQUEST['id'];?>">写真</a>
			<a class="list-group-item list-group-item-action waves-effect" href="searth.user.main.douga.php?id=<?php echo $_REQUEST['id'];?>">動画</a>
	<a class="list-group-item list-group-item-action waves-effect" href="searth.user.main.syoseki.php?id=<?php echo $_REQUEST['id'];?>">書籍</a>
	<!-- 		<a class="list-group-item list-group-item-action waves-effect" href="searth.user.main.hanbai.php?id=<?php echo $_REQUEST['id'];?>">販売</a>-->
		<!--	<a class="list-group-item list-group-item-action waves-effect"  href="searth.user.main.sigot.php?id=<?php echo $_REQUEST['id'];?>">プロジェクト</a> -->
	<!--		<a class="list-group-item list-group-item-action waves-effect" href="searth.user.main.friend.php?id=<?php echo $_REQUEST['id'];?>">フォロー・フォロワー</a>-->
			<a class="list-group-item list-group-item-action waves-effect" href="searth.login.php?id=<?php echo $_REQUEST['id'];?>">メッセージ</a>


	    		        </nav>


	    						</div>

<div class="col-md-9">


			  <!--②/左コメント終-->

			  <!--③右コメント始-->
		<p>宛先：<?php echo $post['simei']; ?><?php echo $post['name']; ?></p>


<form action="" method="post">

	<dl>
	<dt>メッセージ</dt>
	<dd>
	<input type="text" name="message" size="75" maxlength="255"value=""/>
	<?php if ($error['message'] == 'blank'): ?>

	<div class="alert alert-danger" role="alert">メッセージを入力してください</div>
	<?php endif; ?>
	</dd>
	</dl>

	<div>
		<input type="submit" value="送信"/>
	</div>

	</form>
</div>

</div>

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
