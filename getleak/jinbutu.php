
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="EARTHは、同じ職業の人たちと交流を深めることのできるソーシャルユーティリティサイトです。EARTHを利用すれば、同じ職業の人と質問し合い最新の情報をチェックしたり、写真をアップロードしたり(枚数は無制限)、リンクや動画を投稿したり、新たな可能性を.">
	<title>EARTH</title>
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

<?php

session_start();
header('Expires: -1');
header('Cache-Control:');
header('Pragma:');
require('dbconnect.php');

$name =  $_REQUEST['id'];

$sql = "SELECT id, simei,name,job,tosi,kokuseki,message,seibetu FROM members WHERE simei like '%{$name}%' ORDER BY created DESC LIMIT 10" ;
  $record = mysql_query($sql) or die(mysql_error());
?>





<div class="wrapper">
    <header class="header">
      	<section class="earth1">

		<a href="taitol.php"><img src="img/EARTH4.png" width="180" height=40" alt="EARTH"></a>
     		</section>

	<section class="earth2">
<form action="searth.php" name="search1" method="post">
	<dl class="search1" >
		<dt><input type="text" name="search" value="<?php echo $name;?>" placeholder="Earthの検索またはチャンネル" autocomplete="off"/></dt>
		<dd><button><span></span></button></dd>
	</dl>
	</form>


</section>
<section class="earth3">
<a href="login.php" ><img src="img/user.png" alt="<?php echo $member['simei']; ?><?php echo $member['name']; ?>"  title="<?php echo $member['simei']; ?><?php echo $member['name']; ?>" style="border-radius: 100px;"  align="middle"width="4%" height="5%" vspace="10"hspace="5"></a>


</section>

   </header>

<main class="contents">

<div id="menu">
<ul>
<li><a href="google.php?id=<?php echo $name; ?>">検索</a></li>
<li><a href="sured.php?id=<?php echo $name; ?>">スレッド</a></li>
<li><a href="google.news.php?id=<?php echo $name; ?>">ニュース</a></li>
<li><a href="jinbutu.php?id=<?php echo $name; ?>">チャンネル</a></li>

<li><a href="flickr.php?id=<?php echo $name; ?>">写真</a></li>
<li><a href="#">動画</a></li>
<li><a href="#">質問</a></li>
<li><a href="phpquery/amazon.php?id=<?php echo $name; ?>">ショッピング</a></li>
<li><a href="ibent.php?id=<?php echo $name; ?>">イベント</a></li>
<li><a href="hotppper/index.php?id=<?php echo $name; ?>">レストラン</a></li>


</ul>
</div>


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



    <?php if (!empty($images)): ?>

<?php foreach ($images as $i => $img): ?>
<?php if ($i): ?>
     <hr />
<?php endif; ?>
     </br>
	<section class="syasin">
       <img src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>"width="50%" height="10%"  vspace="0"hspace="3" style="border-radius: 10px;" alt="画像<?=$i+1?>">
	</section>

<?php endforeach; ?>

<?php endif; ?>

<?php
$kml = mysql_num_rows($arai);

if($kml == 0){

      echo "<img src='img/user.png' alt='' width='50%' height='10%' vspace='0'hspace='3' style='border-radius: 10px'>";


}else{


}
?>
</br>


					 <a href="searth.user.php?id=<?php echo $post['id']; ?>"><?php echo $post['simei']; ?><?php echo $post['name']; ?></a>
				<?php echo $post['kokuseki']; ?>
				<?php echo $post['tosi']; ?>
				<?php echo $post['seibetu']; ?>
				<?php echo $post['job']; ?><br>
				<?php echo $post['message']; ?><br>


			</section>
		</section>
</div>
	<?php
	endwhile;
	?>
	</section>
      <section class="contents__inner2">

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 広告　箱 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-3518678681279293"
     data-ad-slot="4522055769"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
      </section>

    </main>
<footer class="footer">
      <p>フッター</p>
    </footer>


</body>
</html>
