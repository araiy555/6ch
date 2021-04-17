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
<title>
Post-Image
</title>
</head>
<body>
<form action="profile.check.php" method="post" enctype="multipart/form-data"  accept="image/*">
<input type="file" name="file" id="file"/>
<input type="submit" value="OK"/>
</form>
</body>
</html>