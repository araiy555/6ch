

<?php

error_reporting(0);

$name = '';

require('dbconnect.php');

if($_REQUEST['search']){
  $value = $_REQUEST['search'];

	$sql = "SELECT id, member_id,taitol,created,gazouid FROM posts  Where taitol like '%{$value}%' AND gazouid ORDER BY created DESC;" ;
	$record = mysql_query($sql) or die(mysql_error());
}else{

	$sql = "SELECT id, member_id,taitol,created,gazouid FROM posts  Where taitol like '%{$name}%' AND gazouid ORDER BY created DESC;" ;
	$record = mysql_query($sql) or die(mysql_error());
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta name="description" content="EARTHは、同じ職業の人たちと交流を深めることのできるソーシャルユーティリティサイトです。EARTHを利用すれば、同じ職業の人と質問し合い最新の情報をチェックしたり、写真をアップロードしたり(枚数は無制限)、リンクや動画を投稿したり、新たな可能性を.">
	<title>EARTH</title>
	<link rel="shortcut icon" href="img/favicon1.ico" type="image/x-icon">


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
	.demo-gallery > ul > li a:hover .demo-gallery-poster {
		background-color: rgba(0, 0, 0, 0.5);
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
	</style>

	<style>
	/*
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
	*/
		body {
	    font-family: Helvetica, Arial, ;
	    font-size: 12px;

	}

																</style>



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



																		<!--Main Navigation-->
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
                          										 <form action="" method="GET" name="sati" onsubmit="return Check()">
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
                          							<form action="gazou.top.php" method="GET" name="satim" onsubmit="return Check2()">
                          											<input type="text" class="form-control" id="keyword"name="search" value="" placeholder="Earthの検索またはチャンネル">
                          							</form>
                          			  			 </div>
                          			    </nav>

                          			  		</div>



																  <header class="header clearfix">
																  	<nav class="navbar  navbar-expand-lg justify-content-center navbar-light scrolling-nav bg-white">


																  	  <!-- Collapsible content -->
																  	  <div class="collapse navbar-collapse" id="basicExampleNav">

																  	 	 <!-- Links -->
																  	 	 <ul class="navbar-nav mr-auto">

																  			 <li class="nav-item dropdown">
																          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
																            aria-expanded="false">設定</a>
																          <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
																            <a class="dropdown-item" href="/EARTH/menu/demo/image/image.Configuration.php">検索設定</a>
																            <a class="dropdown-item" href="/EARTH/menu/demo/language/language.php">言語（language）</a>
																          </div>
																        </li>

																  	 	 </ul>

																  	</nav>




																	<div class="container-fluid">

																		<div class="row">
																			</br>

																				<div class="demo-gallery">
																					<ul id="lightgallery" class="list-unstyled row">

																						<?php
																						$kml = mysql_num_rows($record);

																						if($kml == 0){
																							?>
																<br>



																						<div class="card border-light mb-12" >
																								<div class="card-header">画像</div>
																								<div class="card-body">
																								<?php echo '情報がありませんでした。' ?>
																								</div>
																								</div>
																<?php
																						exit;
																						}else{
																						}
																						?>

																						<?php

																						while($post = mysql_fetch_assoc($record)):
																							?>

																							<?php

																							try {

																								$id = $post['gazouid'];

																								$images = $pdo->query("select * from upload where id='$id'");

																							} catch (PDOException $e) {
																								// 500 Internal Server Errorでテキストとしてエラーメッセージを表示
																								http_response_code(500);
																								header('Content-Type: text/plain; charset=UTF-8', true, 500);
																								exit($e->getMessage());


																							}

																							// HTMLとして表示 (文字コードもここで指定するために上書きする)
																							header('Content-Type: text/html; charset=UTF-8');

																							?>


																							<?php if (!empty($images)): ?>

																								<?php foreach ($images as $i => $img): ?>
																									<?php if ($i): ?>

																									<?php endif; ?>

																									<li class="col-xs-2 col-sm-2 col-md-2" data-responsive="data:image/jpeg;base64,<?=base64_encode($img['data'])?>" data-src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>" data-sub-html="" data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1">

																										<a href="">
																											<img class="img-responsive" src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>" alt="Thumb-<?=$i+1?>">
																										</a>
<?php echo $post['taitol']; ?>

																									</li>




																								<?php endforeach; ?>

																							<?php endif; ?>



																							<?php
																						endwhile;
																						?>
																					</ul>

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
