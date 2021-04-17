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

 $sql = sprintf("SELECT * FROM  kyuujin WHERE member_id = '%s' ORDER BY created DESC",
  mysql_real_escape_string($id)
);

 $record = mysql_query($sql) or die(mysql_error());

?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="EARTHは、同じ職業の人たちと交流を深めることのできるソーシャルユーティリティサイトです。EARTHを利用すれば、同じ職業の人と質問し合い最新の情報をチェックしたり、写真をアップロードしたり(枚数は無制限)、リンクや動画を投稿したり、新たな可能性を.">
	<title>EARTH</title>
	<link rel="stylesheet" type="text/css" href="kiji.css">
  </head>
  <body>



  <!-- メインコンテンツ -->
  <div class="wrapper">
    <header class="header">
	<section class="earth1">

		<a href=""><img src="img/EARTH4.png" width="180" height=40" alt="EARTH"></a>
     		</section>

<section class="earth2">
<form action="searth.php" name="search1" method="post">
	<dl class="search1" >
		<dt><input type="text" name="search" value="" placeholder="Earthの検索またはチャンネル" autocomplete="off"/></dt>
		<dd><button><span></span></button></dd>

	</dl>
	</form>
</section>
	<section class="earth3">
		<a href="touroku.php"><img src="img/ranking1.png" alt="ランキング"  title="ランキング" style="border-radius: px;"  align="middle"width="3%" height="3%" vspace="10"hspace="10"></a>
		<a href="date.php"><img src="img/hensyu.png" alt="投稿"  title="投稿" style="border-radius: px;"  align="middle"width="3%" height="3%" vspace="10"hspace="10"></a>
		<a href="kiji.input.php" ><img src="img/toukou.png" alt="アップロード"  title="アップロード"  style="border-radius: px;" align="middle"width="3%" height="3%" vspace="10"hspace="10"></a>
		<a href="touroku.php"><img src="img/syupin.png" alt="アプリケーション"  title="出品"  style="border-radius: px;"  align="middle"width="3%" height="3%" vspace="10"hspace="10"></a>
		<a href="settei.php"><img src="img/user.png" alt="アプリケーション"  title="<?php echo $member['simei']; ?><?php echo $member['name']; ?>" style="border-radius: 100px;"  align="middle"width="4%" height="3%" vspace="10"hspace="10"></a>
		<a href="#modal-p01"><img src="img/EARTH7.png" alt="アプリケーション"  title="アプリケーション" style="border-radius: 100px;"  align="middle"width="4%" height="3%" vspace="10"hspace="10"></a>
	</section>


<section class="modal-window" id="modal-p01">
<div class="modal-inner">
						<section class="TV">
							<a href="https://abema.tv/"><img src="img/TV.png" title="TV"alt="TV" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>TV</a>
						</section>
						<section class="news">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/news.png" title="ニュース"alt="ニュース" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>ニュース</a>
						</section>
						<section class="kisyou">
							<a href="kisyou.php"><img src="img/tenki.png" title="天気"alt="天気" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>天気</a>
						</section>
						<section class="map">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/map.png" title="マップ"alt="マップ" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>マップ</a>
						</section>
						<section class="geam">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/geam.png" title="ゲーム"alt="ゲーム" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>ゲーム</a>
						</section>
						<section class="music">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/music.png" title="ミュージック"alt="ミュージック" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>ミュージック</a>
						</section>
						<section class="situmon">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/situmon.png" title="質問"alt="質問" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>質問</a>
						</section>
						<section class="kmyu">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/kmyu.png" title="プロジェクト"alt="プロジェクト" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>プロジェクト</a>
						</section>
					 	<section class="gazou">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/gazou.png" title="画像"alt="画像" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>画像</a>
						</section>
						<section class="douga">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/douga.png" title="動画"alt="動画" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>動画</a>
						</section>
						<section class="shoping">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/shoping.png" title="ショッピング"alt="ショッピング" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>ショッピング</a>
						</section>
						<section class="ranking">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/ranking.png" title="ランキング"alt="ランキング" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>ランキング</a>
						</section>
						<section class="mail">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/mail.png" title="メール"alt="メール" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>メール</a>
						</section>
						<section class="maney">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/maney.png" title="クラウドソーシング"alt="クラウドソーシング" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>クラウドソーシング</a>
						</section>
						<section class="akusyu">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/akusyu.png" title="クラウドファウンティング"alt="クラウドファウンティング" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>クラウドファウンティング</a>
						</section>
						<section class="dcter">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/dcter.png" title="医療"alt="医療" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>医療</a>
						</section>
						<section class="fasyon">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/fashon.png" title="医療"alt="医療" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>ファッション</a>
						</section>
						<section class="gakusei">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/gakusei.png" title="医療"alt="医療" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>学生</a>
						</section>
						<section class="syakaijin">
							<a href=""onClick="window.alert('現在開発です。')"><img src="img/syakaijin.png" title="医療"alt="医療" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>社会人</a>
						</section>
						<section class="kyujin">
						<a href=""onClick="window.alert('現在開発です。')"><img src="img/kyujin.png" title="医療"alt="医療" align="middle"　width="5%" height="50%" vspace="10"hspace="10"><br>求人</a>
						</section>


</div>
<a href="kiji.main.php" class="modal-close">&times;</a>
</section>

   </header>
    <div class="contents">
      <section class="contents__inner1">
      		<div id="menu">
		<ul>
		<li><a href="main.php">データ</a></li>
		<li><a href="friend.php">友達</a></li>
		<li><a href="kiji.main.php">記事</a></li>
		<li><a href="gazou.main.php">写真</a></li>
		<li><a href="douga.main.php">動画</a></li>
		<li><a href="hanbai,main.php">販売</a></li>
		<li><a href="./03.html">依頼</a></li>
		<li><a href="jisseki.php">実績</a></li>
		<li><a href="main.message.php">DM</a></li>
		<li><a href="ranking.php">ランキング</a></li>
		<li><a href="settei.php">設定</a></li>
		<li><a href="logout.php">ログアウト</a></li>
		</ul>
		</div>
      </section>
      <section class="contents__inner2">

		<section class="contents__inner5">

				<section class="taitol">


<?php

require('dbconnect.php');

$lod = $_REQUEST['id'];
 $sql = sprintf(" SELECT  member_id FROM kyuujin WHERE id=%d;",
    mysql_real_escape_string($lod)
);
  $postss = mysql_query($sql) or die(mysql_error());
  $postsss= mysql_fetch_assoc($postss);
?>

<?php
require('dbconnect.php');

if(empty($lod)){
	header('Location: searth.php');
}

$id = $postsss['member_id'];

 $sql = sprintf("SELECT m.seibetu,m.id, m.simei, m.name,m.tosi,m.kokuseki, p.id, p.member_id, p.kategori,p.kinmuti, p.taitol,p.created,p.naiyou, p.gazouid,p.dougaid FROM members m ,kyuujin p  WHERE p.member_id = '%s' AND p.id = %d ORDER BY created DESC",
  mysql_real_escape_string($id),
  mysql_real_escape_string($lod)
);

  $posts = mysql_query($sql) or die(mysql_error());

?>

<?php

require('dbconnect.php');

$id = $postsss['member_id'];
 $sql = sprintf("SELECT m.*, p.* FROM members m, hanbaiposts p WHERE m.id=%d",
    mysql_real_escape_string($id)
);
  $postsxx = mysql_query($sql) or die(mysql_error());
  $postsx = mysql_fetch_assoc($postsxx);

?>







<?php

	if($postcc = mysql_fetch_assoc($posts)):
	?>
		<?php echo $postsx['simei']; ?>
		<?php echo $postsx['name']; ?>
		<?php echo $postsx['kokuseki']; ?>
		<?php echo $postsx['tosi']; ?>
		<?php echo $postcc['kategori']; ?><br>
		<?php echo $postcc['taitol']; ?><br>
		<?php echo $postcc['kinmuti']; ?><br>
				<?php echo $postcc['naiyou']; ?><br>














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
$id = $postsss['member_id'];
$gazou = $postcc['gazouid'];
    $images = $pdo->query("select * from upload where member_id='$id' AND id='$gazou'");


} catch (PDOException $e) {
    // 500 Internal Server Errorでテキストとしてエラーメッセージを表示
http_response_code(500);
header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());


}


?>

<?php
$id = $postsss['member_id'];
$douga = $postcc['dougaid'];
 $sql = sprintf("SELECT * FROM  douga WHERE member_id='$id' AND id='$douga'",
  mysql_real_escape_string($id)
);

 $dougax = mysql_query($sql) or die(mysql_error());

?>




	<?php if (!empty($images)): ?>

<?php foreach ($images as $i => $img): ?>
<?php if ($i): ?>
     <hr />
<?php endif; ?>
     <p>
       <a href="?id=%d"><img src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>"width="50%" height="50%" alt="画像<?=$i+1?>"></a>
	 </p>
<?php endforeach; ?>

<?php endif; ?>


	<?php
	while($douga = mysql_fetch_assoc($dougax)):
	?>

<video src="<?php echo $douga['raw_data']; ?>" width="500" height="400" poster="sample.jpg"  controls  preload>
<source src="<?php echo $douga['raw_data']; ?>" type="video/mp4">
<source src="sample.ogg" type="video/ogg">
<source src="sample.webm" type="video/webm">
</video>


<?php
	endwhile;
	?>


	<?php
	else:
	?>
	<p>その投稿は削除されたか、URL間違えています。</p>
	<?php
	endif;
	?>

</br>


			</section>




</section>



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
$gazou = $postsx['gazouid'];
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
$douga = $postsx['dougaid'];
 $sql = sprintf("SELECT * FROM  douga WHERE member_id='$id' AND id='$douga'",
  mysql_real_escape_string($id)
);

 $dougax = mysql_query($sql) or die(mysql_error());

?>





	<?php if (!empty($images)): ?>

<?php foreach ($images as $i => $img): ?>
<?php if ($i): ?>
     <hr />
<?php endif; ?>

       <a href="?id=%d"><img src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>"width="12%" height="12%" alt="画像<?=$i+1?>"></a>

<?php endforeach; ?>

<?php endif; ?>

	<?php
	while($douga = mysql_fetch_assoc($dougax)):
	?>

<video src="<?php echo $douga['raw_data']; ?>" width="540" height="320" poster="sample.jpg"  controls  preload>
<source src="<?php echo $douga['raw_data']; ?>" type="video/mp4">
<source src="sample.ogg" type="video/ogg">
<source src="sample.webm" type="video/webm">
</video>

<?php
	endwhile;
	?>










</section>

		</section>



      </section>




      <section class="contents__inner3">
	<section class="user">
             <?php if (!empty($profile)): ?>


<?php foreach ($profile as $i => $imge): ?>
<?php if ($i): ?>
     <hr />
<?php endif; ?>
     </br>
	<section class="syasin">
       <img src="data:image/jpeg;base64,<?=base64_encode($imge['data'])?>"width="90%" height="10%"  vspace="0"hspace="3" style="border-radius: 10px;" alt="画像<?=$i+1?>">
	</section>

<?php endforeach; ?>

<?php endif; ?>	</section>

	<section class="seibetu">
	性別：<?php echo $member['seibetu']; ?>
	</section>
	<br>

	<section class="seibetu">
	実名：<?php echo $member['simei']; ?>
	<?php echo $member['name']; ?>
	</section>
	<br>

	<section class="seibetu">
	国籍：<?php echo $member['kokuseki']; ?>
	</section>
	<br>

	<section class="seibetu">
	年齢：<?php echo $member['tosi']; ?>歳
	</section>
	<br>

	<section class="seibetu">
	職業：<?php echo $member['job']; ?><br>
	歴<?php echo $member['syokureki']; ?>年
	</section>
	<br>


	<section class="tourokubi">
	登録日：<?php echo $member['created']; ?>
	</section>
	<br>

	<section class="koushinbi">
	更新日<?php echo $member['modified']; ?>
	</section>
	<br>
      </section>









    </div>
    <footer class="footer">
      <p>コメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメント</p>
    </footer>
  </div>

</body>
</html>
