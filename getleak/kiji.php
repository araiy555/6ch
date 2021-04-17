<?php
session_start();
error_reporting(0);
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
	<title>EARTH</title>
	<link rel="stylesheet" type="text/css" href="データ.css">
  </head>
  <body>
	<div class="wrapper">
		<header class="header">
			<h1 class="clear"><a href="taitol.php"><img src="img/EARTH4.png" width="180" height=40" alt="EARTH"></a></h1>
     	
		</header>



	<section class="contents">
		<section class="contents">
<form action="" method="post" anctype="multipart/form-data">
<?php 

	if(!empty($_POST)){
	//エラー項目の確認
	if($_POST['kategori'] == ''){
	$error['kategori'] = 'blank';
	}
	if($_POST['taitol'] == ''){
	$error['taitol'] = 'blank';
	}
	if($_POST['kiji'] == ''){
	$error['kiji'] = 'blank';
	}
	
	if(empty($error)){
	$_SESSION['join'] = $_POST;
	header('Location: kiji.kakunin.php');
	}
}	
	//書き直しコード
	if ($_REQUEST['action'] == 'rewrite') {
		$_POST = $_SESSION['join'];
		$error['rewrite'] = true;
	}

?>


	<form action="" method="post">
	<dl>
	<dt>カテゴリ<span class="required"></span></dt>
	<dd>
	<select  name="kategori" id="kokuseki"  maxlength="255" value="<?php echo htmlspecialchars($_POST['kategori'],ENT_QUOTES,'UTF-8'); ?>"/>
	<OPTGROUP label="カテゴリ">
<OPTION value="ニュース">ニュース</OPTION>
<OPTION value="経済">経済</OPTION>
<OPTION value="エンタメ">エンタメ</OPTION>
<OPTION value="スポーツ">スポーツ</OPTION>
<OPTION value="IT・科学">IT・科学</OPTION>
<OPTION value="料理">料理</OPTION>
<OPTION value="スポーツ">スポーツ</OPTION>
<OPTION value="アニメ">アニメ</OPTION>
<OPTION value="漫画">漫画</OPTION>
<OPTION value="芸能人">芸能人</OPTION>
<OPTION value="有名人">有名人</OPTION>
<OPTION value="ファッション">ファッション</OPTION>
<OPTION value="IT">IT</OPTION>

<OPTION value="面白">面白</OPTION>

</OPTGROUP>

</select>


<?php if ($error['kategori'] == 'blank'): ?>
	<p class="error">* 記事内容を入力してください</p>
	<?php endif; ?>
	</dd>



	<dt>タイトル</dt>
	<dd>
	<input type="text" name="taitol" size="35" maxlength="255"value="<?php echo htmlspecialchars($_POST['taitol'],ENT_QUOTES,'UTF-8'); ?>"/>	
	<?php if ($error['taitol'] == 'blank'): ?>
	<p class="error">* 記事内容を入力してください</p>
	<?php endif; ?>
	<dd>
	<dt>記事</dt>
	<dd>
	<input type="text" name="kiji" size="35" maxlength="255"value="<?php echo htmlspecialchars($_POST['kiji'],ENT_QUOTES,'UTF-8'); ?>"/>	
	<?php if ($error['kiji'] == 'blank'): ?>
	<p class="error">* 記事内容を入力してください</p>
	<?php endif; ?>
	</dd>

	</dl>
	
	<input type="file" name="file" id="file"/>
	<div>
	<input type="submit" value="投稿"/>
	</div>
	</form>

	</section>
	</section>
<footer class="footer">
      <p>フッター</p>
    </footer>
	</div>	
</body>
</html>