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


<?php

try {

$id = $member['id'];
    $gazou1 = $pdo->query("select * from upload where member_id='$id' LIMIT 1 offset 0");


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


$id = $member['id'];


$sql = "select member_id from profile where member_id='$id' ORDER BY modified DESC LIMIT 1" ;
  $arai = mysql_query($sql) or die(mysql_error());
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php  require_once 'HTML/fabikon.php'; ?>

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
 <div id="loader-bg">
  <img src="img/ajax-loader (4).gif">
 </div>

 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script>
 jQuery(window).on("load", function() {
  jQuery('#loader-bg').hide();
 });
 </script>

 <style media="screen">
 body, a{
 		font-family: Helvetica, Arial, ;
 		font-size: 12px;
 }
 </style>




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
















</head>



	<body >


			<?php  require_once 'nav/nav2.php'; ?>

	<!--/.Navbar-->
	</br>


			<div class="container-fluid">
				<!-- Card image -->
				<?php require_once 'background.top.php';?>

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


				<!-- Card -->
				<?php require_once 'navgetion/nav3.php';?>
<br>
		<!-- Grid row -->
		<div class="row">

				<!-- Grid column -->
				<div class="col-md-3  d-none d-sm-block">

					<?php require_once 'navgetion/nav1.php';?>


						</div>


									<div class="col-md-6">
<br>
	<div class="card ">
	    <div class="card-header">データ</div>
	    <div class="card-body">

	        <p class="card-text">			<?php
					$detahenkou = $member['detahenkou'];

								if($detahenkou == NULL ){
					         echo 'データが見つかりませんでした';
								}else{
									echo $detahenkou;
								}
								?>
</p>
	    </div>
			</div>
<br>
		<div class="card ">
		    <div class="card-header">更新日</div>
		    <div class="card-body">

		        <p class="card-text">			<?php
						$detahenkou = $member['detahenkou'];

									if($detahenkou == NULL ){
						         echo 'データが見つかりませんでした';
									}else{
										echo $detahenkou;
									}
									?>
	</p>
		    </div>
				</div>


</br>
			<div class="card ">
					<div class="card-header">自己紹介</div>
					<div class="card-body">

							<p class="card-text">			<?php

								$message = $member['message'];

								if($message == NULL){
									 echo 'データが見つかりませんでした';
								}else{
									echo $message;
								}
								?>
		</p>
					</div>
					</div>


					</br>
								<div class="card ">
										<div class="card-header">URL</div>
										<div class="card-body">

												<p class="card-text">		<?php

													$url = $member['url'];

													if($url == NULL){
														 echo 'データが見つかりませんでした';
													}else{
														echo $url;
													}
													?>
							</p>
										</div>
										</div>





			</br>

			<div class="card ">
					<div class="card-header">連絡番号</div>
					<div class="card-body">

							<p class="card-text">		<?php

								$renrakubango = $member['renrakubango'];

								if($renrakubango == NULL){
									 echo 'データが見つかりませんでした';
								}else{
									echo $renrakubango;
								}
								?>

		</p>
					</div>
					</div>

</br>

			<div class="card ">
					<div class="card-header">連絡アドレス</div>
					<div class="card-body">

							<p class="card-text">	<?php

							$renrakuadoresu = $member['renrakuadoresu'];

							if($renrakuadoresu == NULL){
								 echo 'データが見つかりませんでした';
							}else{
								echo $renrakuadoresu;
							}
							?>


		</p>
					</div>
					</div>
</br>
<div class="card ">
		<div class="card-header">国籍</div>
		<div class="card-body">

				<p class="card-text">	<?php

				$kokuseki = $member['kokuseki'];

				if($kokuseki == NULL){
					 echo 'データが見つかりませんでした';
				}else{
					echo $kokuseki;
				}
				?>


</p>
		</div>
		</div>
</br>
<div class="card ">
		<div class="card-header">年齢</div>
		<div class="card-body">

				<p class="card-text">	<?php

				$tosi = $member['tosi'];

				if($tosi == NULL){
					 echo 'データが見つかりませんでした';
				}else{
					echo $tosi;
				}
				?>


</p>
		</div>
		</div>
</br>
<div class="card ">
		<div class="card-header">職業</div>
		<div class="card-body">

				<p class="card-text">	<?php

				$job = $member['job'];
$syokureki = $member['syokureki'];
				if($tosi == NULL){
					 echo 'データが見つかりませんでした';
				}else{
					echo $job;

				echo '<br>職歴';
				echo $syokureki;

				}
				?>


</p>
		</div>
		</div>
</br>
<div class="card ">
		<div class="card-header">登録日</div>
		<div class="card-body">

				<p class="card-text">	<?php

				$created = $member['created'];

				if($created == NULL){
					 echo 'データが見つかりませんでした';
				}else{
					echo $created;

				}
				?>


</p>
		</div>
		</div>
</br>
<div class="card ">
		<div class="card-header">更新日</div>
		<div class="card-body">

				<p class="card-text">	<?php

				$modified = $member['modified'];

				if($modified == NULL){
					 echo 'データが見つかりませんでした';
				}else{
					echo $modified;

				}
				?>


</p>
		</div>
		</div>

</div>

		<div class="col-lg-3 col-md-6 mb-lg-0 mb-2">
<br>
			<div class="card border-light mb-6" style="max-width: 18rem;">
					<div class="card-header">トレンド</div>
					<div class="card-body">
							<h5 class="card-title"></h5>
							<p class="card-text"></p>
							<?php require_once 'poster/poster2.php';?>
					</div>

					</div>

	<!-- Grid column -->
		  </div>
			  </div>
</section>



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
