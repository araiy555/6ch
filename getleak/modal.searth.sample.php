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


<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="EARTHは、同じ職業の人たちと交流を深めることのできるソーシャルユーティリティサイトです。EARTHを利用すれば、同じ職業の人と質問し合い最新の情報をチェックしたり、写真をアップロードしたり(枚数は無制限)、リンクや動画を投稿したり、新たな可能性を.">
	<title>EARTH</title>
	<link rel="stylesheet" type="text/css" href="サーチ.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">



</head>
<body>


<?php

	if (!isset($_SESSION['join'])){
		header('Location: taitol.login.php');
	}

$name = $_SESSION['join']['search'];

header('Expires: -1');
header('Cache-Control:');
header('Pragma:');
require('dbconnect.php');



$sql = "SELECT m.id, m.simei, m.name, p.id, p.member_id, p.kategori,p.kiji, p.taitol,p.created FROM members m, posts p WHERE  m.id=p.member_id AND p.taitol like '%{$name}%' AND p.kategori like'%ニュース%' ORDER BY p.created DESC LIMIT 3" ;
  $record = mysql_query($sql) or die(mysql_error());
?>

<?php

$pdo = new PDO('mysql:dbname=mini_bbs;host=localhost','root','1234');
$stmt = $pdo->query('SET NAMES utf8');
// TimeZoneを日本時間に設定する.phpiniにAsia/Tokyo追加
$org_timezone = date_default_timezone_get();
date_default_timezone_set('Asia/Tokyo');

$created = date('Y-m-d H:i:s');

	//登録処理する
	$sql = $pdo->prepare("INSERT INTO topic SET tango=:tango, created=:created");
	$sql->bindValue(':tango', $name);
	$sql->bindValue(':created', $created);
		$flag = $sql->execute();
	
	
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








<div class="wrapper">
    <header class="header">
      	<section class="earth1">

		<a href="taitol.php"><img src="img/EARTH4.png" width="180" height=40" alt="EARTH"></a>
     		</section>
	
	<section class="earth2">
<form action="" name="search1" method="GET">
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
<li><a href="jinbutu.following.php?id=<?php echo $name; ?>">チャンネル</a></li>

<li><a href="flickr.php?id=<?php echo $name; ?>">写真</a></li>
<li><a href="#">動画</a></li>
<li><a href="#">質問</a></li>
<li><a href="phpquery/amazon.php?id=<?php echo $name; ?>">ショッピング</a></li>
<li><a href="ibent.php?id=<?php echo $name; ?>">イベント</a></li>
<li><a href="hotppper/index.php?id=<?php echo $name; ?>">レストラン</a></li>


</ul> 
</div>




      <section class="contents__inner1">




       <div class="box11"> 
<?php 
 
if (isset($name)) {
    $str = $name;
} else {
    $str = $_REQUEST['id'];
}
 
$querytag = "https://news.google.com/news/rss/headlines/section/q/$str/ニュース?ned=jp&hl=ja&gl=JP&
"
   ;
 
$gxml = simplexml_load_file($querytag);
 $i = 0;
foreach ($gxml->channel->item as $item) {
  if($i >= 3){
        break;
      }
    echo $item->description;

    $i++;

    
}

?>







</div>

 <div class="box11"> 
<?php
    if (isset($name)) {
        $keyword = urlencode($name);
        $url = "http://wikipedia.simpleapi.net/api?keyword=".$keyword."&output=xml";
        $xml = simplexml_load_file($url);
        if ($xml) {
            echo $xml->result->body;
        }
        else {
            echo "simplexml_load_fileでエラー";
        }
    }
?>


</div>





	<?php

	while($post = mysql_fetch_assoc($record)):
	?>
	
<div class="box11">			
		<section class="koushinbi">

								
								<a href="#modal-p02?id=<?php echo $post['id']; ?>"><?php echo $post['taitol']; ?></a>
								
							
					<section class="modal-window" id="modal-p02?id=<?php echo $post['id']; ?>">
					<div class="modal-inner">
				
				<section class="taitol">
				<?php $lod = $post['id'];?>





<?php
require('dbconnect.php');
if(empty($lod)){
header('Location: searth.php');
}
 $sql = sprintf(" SELECT  member_id FROM posts WHERE id=%d;",
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

 $sql = sprintf("SELECT m.seibetu,m.id, m.simei, m.name,m.tosi,m.kokuseki, p.id, p.member_id, p.kategori,p.kiji, p.taitol,p.created, p.gazouid,p.dougaid FROM members m ,posts p  WHERE p.member_id = '%s' AND p.id = %d ORDER BY created DESC",
  mysql_real_escape_string($id),
  mysql_real_escape_string($lod)
);
  
  $posts = mysql_query($sql) or die(mysql_error());

?>

<?php

require('dbconnect.php');
	
$id = $postsss['member_id'];
 $sql = sprintf("SELECT m.*, p.* FROM members m, posts p WHERE m.id=%d",
    mysql_real_escape_string($id)
);  
  $postsxx = mysql_query($sql) or die(mysql_error());
  $postsx = mysql_fetch_assoc($postsxx);

?>

<?php

require('dbconnect.php');
	
$commentid = $post['id'];
 $sql = sprintf("SELECT * FROM comment WHERE comment_id=%d",
    mysql_real_escape_string($commentid)
);  
  $comment1 = mysql_query($sql) or die(mysql_error());
  

?>

<?php
require('dbconnect.php');


$gazouid = $postsss['member_id'];


$sql = "select member_id from profile where member_id='$gazouid' ORDER BY modified DESC LIMIT 1" ;
  $arai2 = mysql_query($sql) or die(mysql_error());
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
$proid = $postsss['member_id'];
    $images1 = $pdo->query("select * from profile where member_id='$proid' ORDER BY modified DESC LIMIT 1");


} catch (PDOException $e) {
    // 500 Internal Server Errorでテキストとしてエラーメッセージを表示
http_response_code(500);
header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());


}


?>



<?php

	if($postcc = mysql_fetch_assoc($posts)):
	?>

<?php if (!empty($images1)): ?>

<?php foreach ($images1 as $i => $img1): ?>
<?php if ($i): ?>
     <hr />
<?php endif; ?>
     </br>
	<section class="syasin">
       <img src="data:image/jpeg;base64,<?=base64_encode($img1['data'])?>"width="5%" height="5%"  vspace="0"hspace="3" style="border-radius: 10px;" alt="画像<?=$i+1?>">
	</section>

<?php endforeach; ?>
  
<?php endif; ?>

<?php
$kml2 = mysql_num_rows($arai2);

if($kml2 == 0){

      echo "<img src='img/user.png' alt='' width='10%' height='10%' vspace='0'hspace='3' style='border-radius: 10px'>";
	

}else{


}
?>



		<?php echo $postsx['simei']; ?>
		<?php echo $postsx['name']; ?>
		<?php echo $postsx['kokuseki']; ?>
		<?php echo $postsx['tosi']; ?>
		<?php echo $postcc['kategori']; ?><br>
			<?php echo $postcc['taitol']; ?><br>
	
		
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
       <a href="?id=%d"><img src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>"width="50%" height="50%" alt="画像<?=$i+1?>">
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
<?php echo $post['kiji']; ?></br>
コメント

<?php

	while($comment2 = mysql_fetch_assoc($comment1)):
	?>

<?php

require('dbconnect.php');
	
$memberid = $comment2['user_id'];
 $sql = sprintf("SELECT * FROM members WHERE id=%d",
    mysql_real_escape_string($memberid)
);  
  $member1 = mysql_query($sql) or die(mysql_error());
  $member = mysql_fetch_assoc($member1);

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
$pro = $comment2['user_id'];
    $images3 = $pdo->query("select * from profile where member_id='$pro' ORDER BY modified DESC LIMIT 1");


} catch (PDOException $e) {
    // 500 Internal Server Errorでテキストとしてエラーメッセージを表示
http_response_code(500);
header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());


}


?>

<?php
require('dbconnect.php');


$gazouid3 = $comment2['user_id'];


$sql = "select member_id from profile where member_id='$gazouid3' ORDER BY modified DESC LIMIT 1" ;
  $arai3 = mysql_query($sql) or die(mysql_error());
?>




<?php if (!empty($images3)): ?>

<?php foreach ($images3 as $i => $img3): ?>
<?php if ($i): ?>
     <hr />
<?php endif; ?>
     </br>
	<section class="syasin">
       <img src="data:image/jpeg;base64,<?=base64_encode($img3['data'])?>"width="10%" height="10%"  vspace="0"hspace="3" style="border-radius: 10px;" alt="画像<?=$i+1?>">
	</section>

<?php endforeach; ?>
  
<?php endif; ?>


<?php
$kml3 = mysql_num_rows($arai3);

if($kml3 == 0){

      echo "<img src='img/user.png' alt='' width='10%' height='10%' vspace='0'hspace='3' style='border-radius: 10px'>";
	

}else{


}
?>






<?php echo $member['simei']; ?><?php echo $member['name']; ?><?php echo $comment2['comment']; ?><br>

<?php
	endwhile;
	?>

<a href="kouhyouka.php?id=<?php echo $post['id']; ?>">高評価</a> 

       			
<a href="teihyouka.php?id=<?php echo $post['id']; ?>">低評価</a>        
			        


<form action="comment.php?id=<?php echo $post['id']; ?>" name="search1" method="post">
	<dl class="search1" >
		<dt><input type="text" name="search"  placeholder="コメント" autocomplete="off"/></dt>
		<dd><button><span></span></button></dd>
		
		
	</dl>
	</form>



			

			</div>	
		






 <a href="#!" class="modal-close">&times;</a>

								
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
$gazouid2 = $post['member_id'];
    $images2 = $pdo->query("select * from profile where member_id='$gazouid2' ORDER BY modified DESC LIMIT 1");


} catch (PDOException $e) {
    // 500 Internal Server Errorでテキストとしてエラーメッセージを表示
http_response_code(500);
header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());


}


?>

<?php
require('dbconnect.php');


$id = $post['member_id'];


$sql = "select member_id from profile where member_id='$id' ORDER BY modified DESC LIMIT 1" ;
  $arai = mysql_query($sql) or die(mysql_error());
?>

		
		
			<section class="midori">
<?php if (!empty($images2)): ?>

<?php foreach ($images2 as $i => $img2): ?>
<?php if ($i): ?>
     <hr />
<?php endif; ?>
  
		
   	
		<section class="syasin">


		<img src="data:image/jpeg;base64,<?=base64_encode($img2['data'])?>"width="10%" height="5%"  vspace="0"hspace="3" style="border-radius: 10px;" alt="画像<?=$i+1?>">



	</section>

<?php endforeach; ?>
  
<?php endif; ?>

		<section class="kou">

			<?php
$kml = mysql_num_rows($arai);

if($kml == 0){

      echo "<img src='img/user.png' alt='' width='10%' height='5%' vspace='0'hspace='3' style='border-radius: 10px'>";
    
		
}else{

}
?>
<a href="searth.user.following.php?id=<?php echo $post['member_id']; ?>"><?php echo $post['simei']; ?><?php echo $post['name']; ?></a> 

		<?php echo $post['kategori']; ?></br>


	</section>

<section class="sita">

	<br>	<?php echo $post['kiji']; ?>
<br><?php echo $post['created']; ?><br>

</section>

<section class="sita">
				
<?php
$commentx = $post['id'];
$comment1 = "SELECT (SELECT COUNT(*) FROM comment WHERE comment_id = '$commentx') AS count FROM comment limit 0,1";
        mysql_real_escape_string($comment1);
  $comment2 = mysql_query($comment1) or die(mysql_error());
?>

	<?php

	while($comment3 = mysql_fetch_assoc($comment2)):
	?>
	



					コメント：<?php echo $comment3['count']; ?>       
	<?php
	endwhile;
	?>

</section>
 <?php
$kouhyouka = $post['id'];
$kouhyouka1 = "SELECT (SELECT COUNT(*) FROM kouhyouka WHERE hyouka_id = '$kouhyouka') AS count FROM kouhyouka limit 0,1";
        mysql_real_escape_string($kouhyouka1);
  $kouhyouka2 = mysql_query($kouhyouka1) or die(mysql_error());
?>

	<?php

	while($kouhyouka3 = mysql_fetch_assoc($kouhyouka2)):
	?>
	



		いいね：<?php echo $kouhyouka3['count']; ?></br>       
	<?php
	endwhile;
	?>

	 <?php
$teihyouka = $post['id'];
$teihyouka1 = "SELECT (SELECT COUNT(*) FROM teihyouka WHERE hyouka_id = '$teihyouka') AS count FROM teihyouka limit 0,1";
        mysql_real_escape_string($teihyouka1);
  $teihyouka2 = mysql_query($teihyouka1) or die(mysql_error());
?>

	<?php

	while($teihyouka3 = mysql_fetch_assoc($teihyouka2)):
	?>
	



		わるいね：<?php echo $teihyouka3['count']; ?></br>       
	<?php
	endwhile;
	?>
		 
  
 
			

			</section>
		</section>
	</br>
	</br>
</div>
	<?php
	endwhile;
	?>


	</section>
</section>

      <section class="contents__inner2">
      



</br>
<?php
$sql = "SELECT id, simei,name,job,tosi,kokuseki,message,seibetu FROM members WHERE simei like '%{$name}%' ORDER BY created DESC LIMIT 1" ;
  $jinbutu1 = mysql_query($sql) or die(mysql_error());
?>

	<?php
	while($jinbutu = mysql_fetch_assoc($jinbutu1)):

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
$id = $jinbutu['id'];
    $images4 = $pdo->query("select * from profile where member_id='$id' ORDER BY modified DESC LIMIT 1");


} catch (PDOException $e) {
    // 500 Internal Server Errorでテキストとしてエラーメッセージを表示
http_response_code(500);
header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());


}


?>

<?php
require('dbconnect.php');


$jinbutuid = $jinbutu['id'];


$sql = "select member_id from profile where member_id='$jinbutuid' ORDER BY modified DESC LIMIT 1" ;
  $arai4 = mysql_query($sql) or die(mysql_error());
?>





	<section class="box12">

    <?php if (!empty($images4)): ?>

<?php foreach ($images4 as $i => $img4): ?>
<?php if ($i): ?>
     <hr />
<?php endif; ?>
     </br>
	<section class="syasin">
       <img src="data:image/jpeg;base64,<?=base64_encode($img4['data'])?>"width="90%" height="10%"  vspace="0"hspace="3" style="border-radius: 10px;" alt="画像<?=$i+1?>">
	</section>

<?php endforeach; ?>
  
<?php endif; ?>

<?php
$kml4 = mysql_num_rows($arai4);

if($kml4 == 0){

      echo "<img src='img/user.png' alt='' width='95%' height='150%' vspace='20'hspace='7' style='border-radius: 100px'>";

}else{


}
?>



	<a href="searth.user.following.php?id=<?php echo $jinbutu['id']; ?>"><?php echo $jinbutu['simei']; ?><?php echo $jinbutu['name']; ?></a></br>
				<?php echo $jinbutu['kokuseki']; ?>
				<?php echo $jinbutu['tosi']; ?>
				<?php echo $jinbutu['seibetu']; ?>
				<?php echo $jinbutu['job']; ?><br>
				<?php echo $jinbutu['message']; ?><br>
</section>
<?php
	endwhile;
	?>





<?php
$topic1 = "select tango, count(*) as count from topic group by tango order by count desc limit 0,5";
        mysql_real_escape_string($topic1);
  $topic2 = mysql_query($topic1) or die(mysql_error());
?>

<div class="box12"> 
トレンド</br>
	<?php

	while($topic = mysql_fetch_assoc($topic2)):
	?>
	
		<?php echo $topic['tango']; ?>
		<?php echo $topic['count']; ?><br>

	    
	<?php
	endwhile;
	?>

</div>





      </section>









    </main>
 <footer class="footer">

    				<a href="https://earthintral.wordpress.com/">EARTHについて</a>&nbsp;&nbsp;
    				<a href="Terms_of_service.php">利用規約</a>&nbsp;&nbsp;
    				<a href="privacy.php">プライバシー</a>&nbsp;&nbsp;
				<a href=""onClick="window.alert('現在操作方法は開発中です、大変申し訳ございません')">操作方法</a>&nbsp;&nbsp;
				<a href=""onClick="window.alert('現在登録者数は開発中です、大変申し訳ございません')">登録者数</a>&nbsp;&nbsp;
			
    </footer>
</body>
</html>