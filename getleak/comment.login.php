<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="ログイン.css">
	<meta name="description" content="EARTH??A?￣?¶?E???l?????? d?[??邱????≪?e?\?[?V???????[?e?B???e?B?T?C?g??・?BEARTH? p?・?e??A?￣?¶?E???l????????￠??V??i?n?d?`?F?b?N?μ???e?A??^?d?A?b?v???[?h?μ???e(??????3?§?A)?A?????N???a? e?μ???e?A?V?????\?≪?d.">
	<title>EARTH</title>
</head>
<body>
<!-- サイドメニュー -->

  <!-- メインコンテンツ -->
  <div class="wrapper">
    <header class="header">
      <h1 class="clear"><a href=""><img src="img/EARTH4.png" width="180" height="40" alt="EARTH"></a></h1>
   </header>
    <main class="contents">
      <section class="contents__inner">

<?php
	require('dbconnect.php');
	error_reporting(0);
	session_start();

	if($_COOKIE['email'] !=''){
	$_POST['email'] = $_COOKIE['email'];
	$_POST['password'] = $_COOKIE['password'];
	$_POST['save'] = 'on';
	}

	if (!empty($_POST)) {
	//???O?C???????
		if($_POST['email'] !=='' && $_POST['password'] !==""){
		$sql = sprintf('SELECT * FROM members WHERE email="%s" AND password="%s"',
		mysql_real_escape_string($_POST['email']),
		sha1(mysql_real_escape_string($_POST['password']))
		);
		$record = mysql_query($sql) or die(mysql_error());
		if ($table = mysql_fetch_assoc($record)) {
		//ログイン成功
		$_SESSION['id'] = $table['id'];
		$_SESSION['time'] = time();
		if($_POST['save'] =='on'){
		setcookie('email',$_POST['email'],time()+60*60*24*14);
		setcookie('password',$_POST['password'],time()+60*60*24*14);
		}
		header('Location: searth.following.toukou.php');
		} else {
			$error['login'] = 'failed';
		}
	} else {
		$error['login'] = 'blank';
	}
}
?>


<div id="lead">


</div>
<form action="" method="post">
	<dl>
		<dt>メールアドレス</dt>
		<dd>
			<input type="text" name="email" size="35" maxlength="255"
			value="<?php echo htmlspecialchars($_POST['email']); ?>"/>
			<?php if($error['login'] == 'blank'): ?>
			<p class="error">*メールアドレスとパスワードをご記入ください</p>
			<?php endif; ?>
			<?php if($error['login'] == 'failed'): ?>
			<p class="error">メールアドレスかパスワードが間違えています。</p>
			<?php endif; ?>
		</dd>
		<br>
		<dt>パスワード</dt>
		<dd>
			<input type="password" name="password" size="35" maxlength="255"
			value="<?php echo htmlspecialchars($_POST['password']); ?>" />
		</dd>
		<dt></dt>
		<dd>
			<br>
			<input id="save" type="checkbox" name="save" value="on"><label>次回からは自動的にログインする</label>
		</dd>
	</dl>
	<div><input type="submit" value="ログイン"/></div>
</form>
</section>

    </main>
    <footer class="footer">
      <p>フッター</p>
    </footer>
</div>
</body>
</html>
