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
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
	<meta name="description" content="EARTHは、同じ職業の人たちと交流を深めることのできるソーシャルユーティリティサイトです。EARTHを利用すれば、同じ職業の人と質問し合い最新の情報をチェックしたり、写真をアップロードしたり(枚数は無制限)、リンクや動画を投稿したり、新たな可能性を.">
	<link rel="stylesheet" type="text/css" href="データ.css">

</head>

  <div class="wrapper">
    <header class="header">
     <h1 class="clear"><a href="taitol.php"><img src="img/EARTH4.png" width="180" height=40" alt="EARTH"></a></h1>
     	
   </header>

<main class="contents">
      <section class="contents__inner">


	<section class="seibetu">
	総閲覧数：
	</section>
	</br>
	<section class="seibetu">
	総フォロー数：
	</section>
	</br>
	<section class="seibetu">
	総フォロワー数：
	</section>
	</br>
	<section class="seibetu">
	売上金：
	</section>
	</br>
	<section class="seibetu">
	ポイント：
	</section>
	</br>
	<section class="seibetu">
	依頼数：
	</section>
	</br>
	<section class="seibetu">
	出品数：
	</section>
	</br>
	<section class="seibetu">
	寄付額：
	</section>
	</br>
	<section class="seibetu">
	高評価：
	</section>
	</br>
	<section class="seibetu">
	低評価：
	</section>
	</br>
</section>


   </main> 
    <footer class="footer">
 	<a href="https://earthintral.wordpress.com/">EARTHについて</a>&nbsp;&nbsp;
    				<a href="Terms of service.php">利用規約</a>&nbsp;&nbsp;
    				<a href="privacy.php">プライバシー</a>&nbsp;&nbsp;
				<a href=""onClick="window.alert('現在操作方法は開発中です、大変申し訳ございません')">操作方法</a>&nbsp;&nbsp;
				<a href=""onClick="window.alert('現在登録者数は開発中です、大変申し訳ございません')">登録者数</a>&nbsp;&nbsp;
			    </footer>
   
</div>
 
</html>
