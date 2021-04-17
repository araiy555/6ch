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

try {

$id = $member['id'];
    $images = $pdo->query('select * from upload where member_id='.$id);

} catch (PDOException $e) {
    // 500 Internal Server Errorでテキストとしてエラーメッセージを表示
http_response_code(500);
header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());


}

// HTMLとして表示 (文字コードもここで指定するために上書きする)
header('Content-Type: text/html; charset=UTF-8');

?>

<?php

try {

$id = $member['id'];
    $userimages = $pdo->query("select * from profile where member_id='$id' ORDER BY modified DESC LIMIT 1");


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
	<?php  require_once 'HTML/fabikon.php'; ?>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="css/mdb.min.css" rel="stylesheet">
	<!-- Your custom styles (optional) -->
	<link href="css/style.min.css" rel="stylesheet">

	<link href="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/css/lightgallery.css" rel="stylesheet">

	<link href="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/css/lightgallery.css" rel="stylesheet">
<style>

				.demo-gallery > ul > li a {
						border: 3px solid #FFF;
						border-radius: 3px;
						display: block;
						overflow: hidden;
						position: relative;
						float: center;
				}
				.demo-gallery > ul > li a > img {
						-webkit-transition: -webkit-transform 0.15s ease 0s;
						-moz-transition: -moz-transform 0.15s ease 0s;
						-o-transition: -o-transform 0.15s ease 0s;
						transition: transform 0.15s ease 0s;
						-webkit-transform: scale3d(1, 1, 1);
						transform: scale3d(1, 1, 1);
						height: 100%;
						width: 100%;
				}
				.demo-gallery > ul > li a:hover > img {
						-webkit-transform: scale3d(1.1, 1.1, 1.1);
						transform: scale3d(1.1, 1.1, 1.1);
				}
				.demo-gallery > ul > li a:hover .demo-gallery-poster > img {
						opacity: 1;
				}
				.demo-gallery > ul > li a .demo-gallery-poster {
						background-color: rgba(0, 0, 0, 0.1);
						bottom: 0;
						left: 0;
						position: absolute;
						right: 0;
						top: 0;
						-webkit-transition: background-color 0.15s ease 0s;
						-o-transition: background-color 0.15s ease 0s;
						transition: background-color 0.15s ease 0s;
				}
				.demo-gallery > ul > li a .demo-gallery-poster > img {
						left: 50%;
						margin-left: -10px;
						margin-top: -10px;
						opacity: 0;
						position: absolute;
						top: 50%;
						-webkit-transition: opacity 0.3s ease 0s;
						-o-transition: opacity 0.3s ease 0s;
						transition: opacity 0.3s ease 0s;
				}
				.demo-gallery > ul > li a:hover .demo-gallery-poster {
						background-color: rgba(0, 0, 0, 0.5);
				}

		</style>
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


																	<header class="header clearfix">
																		<br>
																		<?php require_once 'background.top.php';?>

																			  <div class="container-fluid">
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

																																																																																			<?php
																																																																																			$id = $member['id'];


																																																																																			$sql = "select member_id from profile where member_id='$id' ORDER BY modified DESC LIMIT 1" ;
																																																																																			  $arai = mysql_query($sql) or die(mysql_error());
																																																																						?>

																																																																																			<?php

																																																																																			$kml = mysql_num_rows($arai);

																																																																																			if($kml == 0){

																																																																																						echo "<img class='img-thumbnail' src='img/noimage.png' class='rounded-circle z-depth-1' width='50%' style='border-radius: 50px;' alt='読み込み中…'>";

																																																																																			}else{


																																																																																			}
																																																																																			?>
																																																																						<?php if (!empty($userimages)): ?>

																																																																						<?php foreach ($userimages as $i => $img): ?>
																																																																						<?php if ($i): ?>

																																																																						<?php endif; ?>


																																																																						</br>


																																																																						<div class="photo">

																																																																											<img class="boxbox" src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>" width="40%" style="border-radius: 200%;" alt="読み込み中…">

																																																																									</div>
																																																																									<!-- Card image-->
																																																																								<?php endforeach; ?>

																																																																								<?php endif; ?>

																											<div id="box3" class="boxbox">
																											 <p><?php echo $member['simei']; ?><?php echo $member['name']; ?></p>
																											</div>
																										</div>
																									</span>
																								</div>
																					  </div>


																			              <?php require_once 'navgetion/nav3.php';?>
																			<div class="row">
																				<!-- Grid column -->
																		    <div class="col-md-3  d-none d-sm-block">


																	<?php require_once 'navgetion/nav1.php';?>


																						</div>


																				<div class="col-md-9">
																					<br>
																					<div class="card ">
																							<div class="card-header">画像</div>
																							<div class="card-body">

																																																	<p class="card-text">
																																																		<?php
																																																			$kml = mysql_num_rows($record);

																																																			if($kml == 0){

																																																		echo '情報がありませんでした';
																																																			exit;

																																																			}else{
																																																			}
																																																			?>

																																													</p>

</br>

			<div class="demo-gallery">
			          <ul id="lightgallery" class="list-unstyled row">


												<?php if (!empty($images)): ?>

												<?php foreach ($images as $i => $img): ?>
												<?php if ($i): ?>

												<?php endif; ?>




												 <li class="col-xs-2 col-sm-2 col-md-2" data-responsive="data:image/jpeg;base64,<?=base64_encode($img['data'])?>" data-src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>" data-sub-html="" data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1">

												       <a href="">
												     <img class="img-responsive" src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>" alt="Thumb-<?=$i+1?>">
													</a>
													</li>



												<?php endforeach; ?>
												<p class="card-text"><?php echo '情報がありませんでした';?></p>
												<?php endif; ?>

		</ul>


</div>
		</div>
																					</div>





																			</div>

																			        </div>

																			        </div>





																						<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
																						<script src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js"></script>
																						<script src="https://cdn.rawgit.com/sachinchoolur/lg-pager.js/master/dist/lg-pager.js"></script>
																						<script src="https://cdn.rawgit.com/sachinchoolur/lg-autoplay.js/master/dist/lg-autoplay.js"></script>
																						<script src="https://cdn.rawgit.com/sachinchoolur/lg-fullscreen.js/master/dist/lg-fullscreen.js"></script>
																						<script src="https://cdn.rawgit.com/sachinchoolur/lg-zoom.js/master/dist/lg-zoom.js"></script>
																						<script src="https://cdn.rawgit.com/sachinchoolur/lg-hash.js/master/dist/lg-hash.js"></script>
																						<script src="https://cdn.rawgit.com/sachinchoolur/lg-share.js/master/dist/lg-share.js"></script>
																						<script>
																						lightGallery(document.getElementById('lightgallery'));
																						</script>




																				<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
																				<!-- Bootstrap tooltips -->
																				<script type="text/javascript" src="js/popper.min.js"></script>
																				<!-- Bootstrap core JavaScript -->
																				<script type="text/javascript" src="js/bootstrap.min.js"></script>
																				<!-- MDB core JavaScript -->
																				<script type="text/javascript" src="js/mdb.min.js"></script>
																			</body>
</html>
