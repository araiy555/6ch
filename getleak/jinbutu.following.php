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
	header('Location: searth.login2.php');
}
?>
<?php


header('Expires: -1');
header('Cache-Control:');
header('Pragma:');
require('dbconnect.php');


$name =  $_REQUEST['id'];


$sql = "SELECT id, simei,name,job,tosi,kokuseki,message,seibetu FROM members WHERE simei like '%{$name}%' ORDER BY created DESC LIMIT 10" ;
  $record = mysql_query($sql) or die(mysql_error());
?>





<?php
error_reporting(0);
	if(!empty($_GET)){
	//エラー項目の確認

	if($_GET['search'] == ''){
	$error['search'] = 'blank';
	}
	if(empty($error)){
	$_SESSION['join'] = $_GET;
	header('Location: searth.following.php');
	}
}
?>











<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Earth</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
  <link href='../src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="demo.css" rel="stylesheet">


		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />





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

<body>

  <header class="header clearfix">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>
    </button>


		<section class="earth1">

		<a href="taitol.php"><img src="img/EARTH4.png" width="100" height="25" alt="EARTH"></a>
		</section>

				<section class="earth2">
					<form action="searth.following.php" method="GET" name="sati" onsubmit="return Check()">
									<input type="text" class="form-control" id="keyword"name="search" value="<?php echo $name;?>" value="" placeholder="Earthの検索またはチャンネル">
					</form>



		</section>
		<section class="earth3">
		<a href="login.php" ><img src="img/user.png" alt="<?php echo $member['simei']; ?><?php echo $member['name']; ?>"  title="<?php echo $member['simei']; ?><?php echo $member['name']; ?>" style="border-radius: 100px;"  align="middle"width="4%" height="5%" vspace="10"hspace="5"></a>


		</section>


  </header>

  <nav class="vertical_nav">
    <ul id="js-menu" class="menu">


			<li class="menu--item">
				<a href="taitol.php" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">ホーム</span>
				</a>
			</li>


			<li class="menu--item">
				<a href="searth.following.php?id=<?php echo $name; ?>" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">ニュース</span>
				</a>
			</li>
			<li class="menu--item">
				<a href="sured.php?id=<?php echo $name; ?>" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">スレッド</span>
				</a>
			</li>
		<!--	<li class="menu--item">
				<a href="google.news.php?id=<?php echo $name; ?>" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">ニュース</span>
				</a>
			</li>-->
			<li class="menu--item">
				<a href="jinbutu.following.php?id=<?php echo $name; ?>" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">チャンネル</span>
				</a>
			</li>

			<li class="menu--item">
				<a href="flickr.php?id=<?php echo $name; ?>" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">写真</span>
				</a>
			</li>
			<li class="menu--item">
				<a href="flickr.php?id=<?php echo $name; ?>" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">動画</span>
				</a>
			</li>
			<li class="menu--item">
				<a href="flickr.php?id=<?php echo $name; ?>" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">質問</span>
				</a>
			</li>
			<li class="menu--item">
				<a href="flickr.php?id=<?php echo $name; ?>" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">ショッピング</span>
				</a>
			</li>
			<li class="menu--item">
				<a href="flickr.php?id=<?php echo $name; ?>" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">イベント</span>
				</a>
			</li>








    </ul>

    <button id="collapse_menu" class="collapse_menu">
      <i class="collapse_menu--icon  fa fa-fw"></i>
      <span class="collapse_menu--label">Recolher menu</span>
    </button>

  </nav>


		<div class="wrapper">
			<div class="wrapper">
			<main class="contents">


				      <section class="contents__inner1">

				<?php
				$kml = mysql_num_rows($record);

				if($kml == 0){
				echo "該当データはありません";
				exit;
				}else{
				echo "出力結果";

				}
				?>
					<?php

					while($post = mysql_fetch_assoc($record)):
					?>
				<div class="box11">
						<section class="koushinbi">

							<section class="midori">

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
				$id = $post['id'];
				    $images = $pdo->query("select * from profile where member_id='$id' ORDER BY modified DESC LIMIT 1");


				} catch (PDOException $e) {
				    // 500 Internal Server Errorでテキストとしてエラーメッセージを表示
				http_response_code(500);
				header('Content-Type: text/plain; charset=UTF-8', true, 500);
				    exit($e->getMessage());


				}


				?>
				<?php
				require('dbconnect.php');


				$id = $post['id'];


				$sql = "select member_id from profile where member_id='$id' ORDER BY modified DESC LIMIT 1" ;
				  $arai = mysql_query($sql) or die(mysql_error());
				?>



				 		<?php
				$kml = mysql_num_rows($arai);

				if($kml == 0){

				      echo "<img src='img/user.png' alt='' width='50%' height='10%' vspace='0'hspace='3' style='border-radius: 10px'>";

				}else{


				}
				?>

				       <?php if (!empty($images)): ?>

				<?php foreach ($images as $i => $img): ?>
				<?php if ($i): ?>
				     <hr />
				<?php endif; ?>


						<section class="card1">
							<img class="card-img1" src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>"width="100%" height="10%"  vspace="0"hspace="3" style="border-radius: 10px;" alt="画像<?=$i+1?>">
							<div class="card-content1">
								<h1 class="card-title1"><a href="searth.user.following.php?id=<?php echo $post['id']; ?>"><?php echo $post['simei']; ?><?php echo $post['name']; ?></a></h1>
								<p class="card-text1">
								<?php echo $post['kokuseki']; ?>
								<?php echo $post['tosi']; ?>
								<?php echo $post['seibetu']; ?>
								<?php echo $post['job']; ?>
								<?php echo $post['message']; ?></p>
							</div>
							<div class="card-link1">
								<a href="http://webcreatorbox.com/about">profile</a>
								<a href="http://webcreatorbox.com/about">follow</a>
								 <a href="#" class="btn btn-primary">この人について</a>
							</div>
						</section>

				<?php endforeach; ?>

				<?php endif; ?>


  </div>


						  </div>


						</section>
					</section>

					<?php
					endwhile;
					?>





			    </main>

    </section>

  </div>

  <script src="../dist/vertical-responsive-menu.min.js"></script>



</body>



</html>
