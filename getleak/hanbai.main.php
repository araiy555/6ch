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

    // 接続
    $pdo = new PDO('mysql:dbname=mini_bbs;charset=utf8;host=localhost', 'root', '1234', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // SQL実行に失敗した場合にもPDOExceptionを投げる
    ]);

    // 画像データを1次元配列として取得
    // 取り扱いやすいが，画像サイズ総量が大きい場合にメモリがつらい
    // $images = $pdo->query('SELECT img FROM images')->fetchAll(PDO::FETCH_COLUMN, 0);

    // 画像データを取り出せるイテレータとして取得
    // やや取り扱いにくいが，画像サイズ総量が大きくても余裕
$id = $member['id'];
    $profile = $pdo->query("select * from profile where member_id='$id' ORDER BY modified DESC LIMIT 1");


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

 $sql = sprintf("SELECT * FROM  hanbaiposts WHERE member_id = '%s' ORDER BY created DESC",
  mysql_real_escape_string($id)
);

 $record = mysql_query($sql) or die(mysql_error());

?>




<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<title>EARTH</title>


		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

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

		    <header class="header clearfix">

		      		<nav class="navbar  navbar-expand-lg  navbar-light scrolling-nav bg-white">

		        <a class="navbar-brand" href="taitol.php">
		          <img alt="" src="img/EARTH4.png" width="100" height="30" class="d-inline-block align-top" >
		        </a>


		      			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      				<span class="navbar-toggler-icon"></span>
		      			</button>

		      			<div class="collapse navbar-collapse" id="navbarSupportedContent">
		      				<ul class="navbar-nav mr-auto">

		      					<li class="nav-item"><a href="news.php" class="nav-link">ニュース</a></li>
		      					<li class="nav-item"><a class="nav-link" href="jinbutu.top.php">チャンネル</a></li>
		      					<li class="nav-item"><a class="nav-link" href="taitol.php">写真</a></li>
		      					<li class="nav-item"><a class="nav-link" href="douga.anime.php">動画</a></li>
		      					<li class="nav-item"><a class="nav-link" href="situmon.php">質問</a></li>
		      					<li class="nav-item"><a class="nav-link" href="gazou.syoseki.php">書籍</a></li>
		      					<li class="nav-item"><a class="nav-link" href="syoping.php">ショップ</a></li>
		      					<li class="nav-item"><a class="nav-link" href="ibent.top.php">イベント</a></li>
		      					<li class="nav-item"><a class="nav-link" href="map1.php">マップ</a></li>
		      					<li class="nav-item"><a class="nav-link" href="ranking.php">ランキング</a></li>
		      					<li class="nav-item"><a class="nav-link" href="kyuujin.top.php">求人</a></li>
		      				</ul>
		      				<ul class="nav navbar-nav nav-flex-icons ml-auto">
		      					<li class="nav-item">
		      						<a href="main.message.php"class="nav-link"><i class="fa fa-envelope"></i> メール</a>
		      					</li>
		      					<li class="nav-item">
		      						<a href="touroku.php"class="nav-link"><i class="fa fa-comments-o"></i> 新規登録</a>
		      					</li>
		      					<li class="nav-item">
		      						<a href="login.php" class="nav-link"　><i class="fa fa-user"></i> ログイン</a>
		      					</li>
		      					<li class="nav-item dropdown">
		      						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		      							アプリ
		      						</a>
		      						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
		      							<a class="dropdown-item" href="#">Action</a>
		      							<a class="dropdown-item" href="#">Another action</a>
		      							<a class="dropdown-item" href="#">Something else here</a>
		      						</div>
		      					</li>
		      				</ul>
		      			</div>
		      		</nav>

		    <nav>
		    <div>
		    </div>
		    </nav>
		    <nav class="navbar navbar-expand-lg  navbar-light bg-white">

		        <!-- Collapse button -->
		        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
		            aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

		        <!-- Collapsible content -->
		        <div class="collapse navbar-collapse" id="navbarSupportedContent">

		            <!-- Links -->
		            <ul class="navbar-nav mr-auto">
		                <!-- Dropdown -->
		                <li class="nav-item dropdown mega-dropdown">
		                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">News </a>
		                    <div class="dropdown-menu mega-menu row z-depth-1" aria-labelledby="navbarDropdownMenuLink">
		                        <div class="row">
		                            <div class="col-md-5 col-xl-3 sub-menu mt-5 mb-5 pl-4">
		                                <ol class="list-unstyled mx-4 dark-grey-text">
		                                    <li class="sub-title text-uppercase mt-sm"><a class="menu-item" href="">Laptops</a></li>
		                                    <li class="sub-title text-uppercase"><a class="menu-item" href="">Phones</a></li>
		                                    <li class="sub-title text-uppercase"><a class="menu-item" href="">Lifestyle</a></li>
		                                    <li class="sub-title text-uppercase"><a class="menu-item" href="">Technology</a></li>
		                                    <li class="sub-title text-uppercase"><a class="menu-item" href="">Design</a></li>
		                                </ol>
		                            </div>
		                            <div class="col-md-7 col-xl-9">
		                                <div class="row">
		                                    <div class="col-xl-6 mt-5 mb-4 pr-5 clearfix d-none d-md-block">
		                                        <h6 class="sub-title p-sm mb-4 text-uppercase font-weight-bold dark-grey-text">Featured</h6>
		                                        <!--Featured image-->
		                                        <div class="view overlay pb-3">
		                                            <img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(42).jpg" class="img-fluid z-depth-1" alt="First sample image">
		                                            <div class="mask rgba-white-slight flex-center">
		                                                <p></p>
		                                            </div>
		                                        </div>
		                                        <h4 class="mb-2"><a class="news-title" href="">Lorem ipsum dolor sit amet, consectetur isum adipisicing elit.</a></h4>
		                                        <p class="font-small text-uppercase text-muted">By <a class="m-sm" href="#!">Anna Doe</a> - July 15, 2017</p>
		                                    </div>
		                                    <div class="col-xl-6 mt-5 mb-4 pr-5 clearfix d-none d-xl-block">
		                                        <h6 class="sub-title p-sm mb-4 text-uppercase font-weight-bold dark-grey-text">Recent</h6>
		                                        <div class="news-single">
		                                            <div class="row">
		                                                <div class="col-md-4">
		                                                    <!--Image-->
		                                                    <div class="view overlay z-depth-1">
		                                                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(43).jpg" class="img-fluid" alt="Minor sample post image">
		                                                        <div class="mask rgba-white-slight flex-center">
		                                                            <p></p>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-md-8">
		                                                    <a class="news-title smaller mb-1" href="">Duis aute irure dolor reprehenderit in voluptate.</a>
		                                                    <p class="font-small text-uppercase text-muted">July 14, 2017</p>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <div class="news-single">
		                                            <div class="row">
		                                                <div class="col-md-4">
		                                                    <!--Image-->
		                                                    <div class="view overlay z-depth-1">
		                                                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(44).jpg" class="img-fluid" alt="Minor sample post image">
		                                                        <div class="mask rgba-white-slight flex-center">
		                                                            <p></p>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-md-8">
		                                                    <a class="news-title smaller mb-1" href="">Tempore autem reiciendis iste nam dicta.</a>
		                                                    <p class="font-small text-uppercase text-muted">July 14, 2017</p>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <div class="news-single">
		                                            <div class="row">
		                                                <div class="col-md-4">
		                                                    <!--Image-->
		                                                    <div class="view overlay z-depth-1">
		                                                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(41).jpg" class="img-fluid" alt="Minor sample post image">
		                                                        <div class="mask rgba-white-slight flex-center">
		                                                            <p></p>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-md-8">
		                                                    <a class="news-title smaller mb-1" href="">Eligendi dicta sunt amet, totam ea recusandae.</a>
		                                                    <p class="font-small text-uppercase text-muted">July 14, 2017</p>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </li>
		            </ul>
		            <!-- Links -->

		            <!-- Links -->
		            <ul class="navbar-nav nav-flex-icons ml-auto">
		                <li class="nav-item">
		                    <a class="nav-link" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
		                </li>
		                <li class="nav-item">
		                    <a class="nav-link" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
		                </li>
		                <li class="nav-item">
		                    <a class="nav-link" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
		                </li>
		            </ul>
		            <!-- Links -->

		        </div>
		        <!-- Collapsible content -->

		    </nav>





				<!-- Section: Team v.1 -->
				<section class="team-section text-center my-5">
					<!-- Grid row -->
					<div class="row">



								<?php

								while($post = mysql_fetch_assoc($record)):
								?>

							<?php
							try {

									// 接続
									$pdo = new PDO('mysql:dbname=mini_bbs;charset=utf8;host=localhost', 'root', '1234', [
											PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // SQL実行に失敗した場合にもPDOExceptionを投げる
									]);

									// 画像データを1次元配列として取得
									// 取り扱いやすいが，画像サイズ総量が大きい場合にメモリがつらい
									// $images = $pdo->query('SELECT img FROM images')->fetchAll(PDO::FETCH_COLUMN, 0);

									// 画像データを取り出せるイテレータとして取得
									// やや取り扱いにくいが，画像サイズ総量が大きくても余裕
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

						<!-- Grid column -->
				 	 <div class="col-lg-2 col-md-6 mb-lg-0 mb-5">

				 		 <div class="avatar mx-auto">

</br>

								<?php if (!empty($images)): ?>

							<?php foreach ($images as $i => $img): ?>
							<?php if ($i): ?>

							<?php endif; ?>

							<img src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>"width="50%" height="50%"   alt="画像<?=$i+1?>">

							<?php endforeach; ?>

							<?php endif; ?>
						</div>

						  <h5 class="font-weight-bold mt-4 mb-3">	<a href="hanbainaiyou.php?id=<?php echo $post['id']; ?>"> <?php echo $post['taitol']; ?></a></h5>
<p class="grey-text">>テキストテキストテキストテキストテキストテキストテキスト</p>


							<p class="price"><?php echo $post['nedan']; ?></p>

							<div class="orange-text">
							        <i class="fa fa-star"> </i>
							        <i class="fa fa-star"> </i>
							        <i class="fa fa-star"> </i>
							        <i class="fa fa-star"> </i>
							        <i class="fa fa-star"> </i>
							  </div>
							       
</div>
							        <!-- Grid column -->


						<?php
						endwhile;
						?>

					</div>
					<!-- Grid row -->
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
