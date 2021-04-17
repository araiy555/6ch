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
require('dbconnect.php');
$id = $member['id'];
 $sql = sprintf("SELECT * FROM  posts  where member_id='$id' ORDER BY created DESC");
 mysql_real_escape_string($id);
 $record = mysql_query($sql) or die(mysql_error());
?>
<?php
require('dbconnect.php');


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
	<style media="screen">
  body, a{
  		font-family: Helvetica, Arial, ;
  		font-size: 12px;
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

				</br>

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
													<?php require_once 'user/user1.php';?>
													<div id="box3" class="boxbox">
													 <p><?php echo $member['simei']; ?><?php echo $member['name']; ?></p>
													</div>
												</div>
											</span>
										</div>
							  </div>



					<?php require_once 'navgetion/nav3.php';?>
					<br>
											<div class="row">
												<!-- Grid column -->
												<div class="col-md-3 d-none d-sm-block">


									<?php require_once 'navgetion/nav1.php';?>


														</div>



																				<div class="col-md-9">
																					<br>
																					<div class="card ">
																							<div class="card-header">動画</div>
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




					<?php

					while($post = mysql_fetch_assoc($record)):
					?>

					<?php
					$id= $post['dougaid'];

					 $sql = sprintf("SELECT * FROM  douga  WHERE id = '$id'",
					  mysql_real_escape_string($id)
					);

					 $record9 = mysql_query($sql) or die(mysql_error());

					?>


					<?php
					while($douga = mysql_fetch_assoc($record9)):
					?>
					<!-- Footer -->
					<section class="my-0">

<div class="row">
					<div class="col-lg-5 col-xl-4">

						<!-- Featured image -->
					              <a href="searth.following.toukou.php?id=<?php echo $post['id']; ?>">

	              									<video  id="my-video" width="250" height="200" >
	              									<source src="<?php echo $douga['raw_data']; ?>" type="video/mp4">
	              									<source src="sample.ogg" type="video/ogg">
	              									<source src="sample.webm" type="video/webm">

	              									</video>
	                                </a>

															</div>

															<div class="col-lg-7 col-xl-8">
<br>
																<!-- Post title -->
															<a href="searth.following.toukou.php?id=<?php echo $post['id']; ?>"><?php echo $post['taitol']; ?></a>
																<!-- Excerpt -->
																<p class="dark-grey-text"><i class="fa fa-id-card-o" aria-hidden="true"></i><?php echo $post['kategori']; ?></p>
																<!-- Post data -->
																<?php
																$saiseix = $post['id'];
																$saisei1 = "select count(*) as cnt from saiseisu where saisei_id = '$saiseix'";
																				mysql_real_escape_string($saisei1);
																	$saisei2 = mysql_query($saisei1) or die(mysql_error());
																?>


<?php
while($saisei = mysql_fetch_assoc($saisei2)):
?>
<i class="fa fa-tv" aria-hidden="true"></i> <?php echo $saisei['cnt']; ?>PV
<?php
endwhile;
?>
<?php
$commentx = $post['id'];
$comment5 = "SELECT (SELECT COUNT(*) FROM comment WHERE comment_id = '$commentx') AS count FROM comment limit 0,1";
			 mysql_real_escape_string($comment5);
 $comment2 = mysql_query($comment5) or die(mysql_error());
?>


 <?php

 while($comment3 = mysql_fetch_assoc($comment2)):
 ?>
			 &nbsp;&nbsp;	<i class="fa fa-commenting-o" aria-hidden="true"></i>：<?php echo $comment3['count']; ?>
 <?php
 endwhile;
 ?>




																<p><i class="fa fa-globe" aria-hidden="true"></i> <?php echo $post['created']; ?></p>
																<!-- Read more button -->
																<a href="searth.following.toukou.php?id=<?php echo $post['id']; ?>" class="btn btn-primary btn-md">視聴する</a>

															</div>
														</div>
													</section>
									<?php
										endwhile;
										?>

										<?php
												endwhile;
												?>

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
