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
$id = $member['id'];
$sql = "select member_id from profile where member_id='$id' ORDER BY modified DESC LIMIT 1" ;
  $arai = mysql_query($sql) or die(mysql_error());
?>
<?php

$id = $member['id'];

 $sql = sprintf("SELECT * FROM  posts WHERE member_id = '%s' ORDER BY created DESC",
  mysql_real_escape_string($id)
);

 $record = mysql_query($sql) or die(mysql_error());

?>

<?php

try {

$id = $member['id'];
		$images = $pdo->query("select * from profile where member_id='$id' ORDER BY modified DESC LIMIT 1");
} catch (PDOException $e) {
		// 500 Internal Server Errorでテキストとしてエラーメッセージを表示
http_response_code(500);
header('Content-Type: text/plain; charset=UTF-8', true, 500);
		exit($e->getMessage());


}

// HTMLとして表示 (文字コードもここで指定するために上書きする)
header('Content-Type: text/html; charset=UTF-8');

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

<style media="screen">
body{
		font-family: Helvetica, Arial, ;
		font-size: 12px;
		background-color: #e6ecf0;

}
.wrapper {
  position:relative;
  display:inline-block;
		font-size: 15px;
}

.label {
  position:absolute;
  color:white;
  padding:5px 15px;
}
.label-left-top{
  left:0px;
  top:0px;

}
.label-right-top{
  right:0px;
  top:0px;
}
.label-left-bottom{
  left:0px;
  bottom:0px;
}
.label-right-bottom{
  right:0px;
  bottom:0px;
}

.clearfix:after {
  content: "";
  clear: both;
  display: block;
  bottom: 0;
}
.boxbox{
  float: left;
	bottom: 0;

}
.boxbox p{
	position: absolute;
     bottom: 0;
  	font-size: 20px;

}
#box3 a {
  position: absolute;
  bottom: 0;
}
@media(max-width: 20px) {
  .boxbox{
    float: none;
		  bottom: 0;
  }
}


</style>

</head>


	<body>

	<?php  require_once 'nav/nav2.php'; ?>

	<?php require_once 'background.top.php';?>

				<!-- Jumbotron -->

				  <!-- Card image -->
				  <div class="view overlay rounded-top">

							<div class="wrapper">

								<?php

								$kml = mysql_num_rows($error);

								if($kml == 0){

											echo "<img class='background' src='img/black.jpg'  width='100%'  alt='読み込み中…'>";

								}else{


								}
								?>
								<?php if (!empty($background)): ?>

								<?php foreach ($background as $i => $img): ?>
								<?php if ($i): ?>

								<?php endif; ?>

													<img class="background" src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>" width="100%" alt="読み込み中…">

											<!-- Card image-->
										<?php endforeach; ?>

										<?php endif; ?>

													<div class="d-none d-sm-block">
								<span class="label label-right-top"><a href="background.php">背景編集
								</a><a href="profile.php">プロフィール画像編集</a><a href="date.php">データ編集</a>
　</span>

								</div>
								<span class="label label-left-bottom">
									<div class="clearfix">
										<?php require_once 'user/user1.php';?>
										<div id="box3" class="boxbox">
										 <p><?php echo $member['simei']; ?><?php echo $member['name']; ?></p>
										</div>
									</div>
								</span>
							</div>
				  </div>

				              <?php require_once 'navgetion/nav3.php';?>
													  <div class="container-fluid">
		<!-- Grid row -->
		<div class="row">

		    <!-- Grid column -->
		    <div class="col-md-3 d-none d-sm-block">



					<?php require_once 'navgetion/nav1.php';?>

		        </nav>


						</div>


				<div class="col-md-6">



																																	<p class="card-text">
																																		<?php
																																			$kml = mysql_num_rows($record);

																																			if($kml == 0){
?>

<div class="card border-light mb-3" >

		<div class="card-header">投稿</div>
		<div class="card-body">
		<?php echo '情報がありませんでした。' ?>
		</div>
		</div>

																																	<?php
																																			exit;

																																			}else{
																																			}
																																			?>

																													</p>

    	<?php

    	while($post = mysql_fetch_assoc($record)):
    	?>



			<div class="example ">


			<div class="list-group">
				<div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">		<a href="searth.following.toukou.php?id=<?php echo $post['id']; ?>"><?php echo $post['taitol']; ?></a>
									</h5>

<ul class="nav navbar-nav nav-flex-icons ml-auto">
									<li class="nav-item dropdown">
			          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
			            aria-haspopup="true" aria-expanded="false">

			          </a>
			          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
			            <!--<a class="dropdown-item" href="edit/edit.top.php?id=<?php echo $post['id']; ?>">投稿を変更</a>-->
			            <a  class="dropdown-item" href = "delete/delete.top.php?id=<?php echo $post['id']; ?>">投稿を削除</a>
			          </div>

			        </li>
</ul>








					</div>
					<div class="d-flex align-items-start"><p class="mb-1"><?php echo $post['kiji']; ?></p></div>

								<?php
								try {


								$id = $member['id'];
								$gazou = $post['gazouid'];
										$images = $pdo->query("select * from upload where member_id='$id' AND id='$gazou'");


								} catch (PDOException $e) {
										// 500 Internal Server Errorでテキストとしてエラーメッセージを表示
								http_response_code(500);
								header('Content-Type: text/plain; charset=UTF-8', true, 500);
										exit($e->getMessage());


								}
								?>

								<?php
								$id = $member['id'];
								$douga = $post['dougaid'];
								 $sql = sprintf("SELECT * FROM  douga WHERE member_id='$id' AND id='$douga'",
									mysql_real_escape_string($id)
								);

								 $dougax = mysql_query($sql) or die(mysql_error());

								?>





									<?php if (!empty($images)): ?>

								<?php foreach ($images as $i => $img): ?>
								<?php if ($i): ?>
								<?php endif; ?>

									<div class="card"><img src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>"width="100%" height="100%" alt="画像<?=$i+1?>"></div>

								<?php endforeach; ?>

								<?php endif; ?>

									<?php
									while($douga = mysql_fetch_assoc($dougax)):
									?>

<div class="card">
								<video src="<?php echo $douga['raw_data']; ?>" width="100%" height="100%" poster="sample.jpg"  controls  preload>
								<source src="<?php echo $douga['raw_data']; ?>" type="video/mp4">
								<source src="sample.ogg" type="video/ogg">
								<source src="sample.webm" type="video/webm">
								</video>
							</div>

								<?php
									endwhile;
									?>
					<small>投稿者：<?php echo $member['simei']; ?><?php echo $member['name']; ?>	<?php echo $member['kokuseki']; ?></small>
						<small><?php echo $post['kategori']; ?><?php echo $post['created']; ?></small>
				</div>

			</div>

	</div>

    	<?php
    	endwhile;
    	?>

			</div>


			<div class="col-lg-3 col-md-3 mb-lg-0 mb-3 d-none d-sm-block">
<br>
				<div class="card border-light mb-3" >
						<div class="card-header">トレンド</div>
						<div class="card-body">
								<h5 class="card-title"></h5>
								<p class="card-text"></p>
								<?php require_once 'poster/poster2.php';?>
						</div>

						</div>
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
