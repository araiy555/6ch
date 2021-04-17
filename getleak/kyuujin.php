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
	<title>EARTH</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">




<style TYPE="text/css">
	<!--
		H1 {
			color: red;
			font-size: 18pt;
			
		}
		#contact-form th {
			background-color: #9bdbea;
			padding: 30px 20px 10px 10px;
			
		}
		#contact-form td {
			background-color: #f7f7ef;
			padding: 10px 20px 10px 10px;
		}
		#contact-form td input {
			width: 1200px;
		}
		#contact-form td textarea {
			width: 1200px;
		}
		form {
			display: inline;
		}
		#errmsg {
			background-color:#E7D3D6;
			border:3px solid #A55952;
			color:#944121;
			font-size:12px;
			margin:10px;
			padding: 10px;
			text-align:left;
			width:800px;
			 
		}
	-->
	</style>


</head>
<body>
	<div class="wrapper">
		<header class="header">
		

		<h1 class="clear"><a href="taitol.php"><img src="img/EARTH4.png" width="180" height=40" alt="EARTH"></a></h1>
     		
		

		</header>


<?php
error_reporting(0);
?>

	<section class="contents">
		<section class="contents">
  
     <form action="kyuujin.toukou.php" method="post" enctype="multipart/form-data">
	<table id="contact-form" border="1" cellpadding="0" cellspacing="0">
<tr>
	<th>
	カテゴリ
	</th>
	
<td><select  name="kategori" id="kokuseki"  maxlength="255"  value="<?php echo htmlspecialchars($_POST['kategori'],ENT_QUOTES,'UTF-8'); ?>"/>
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
	</td>
	</tr>

<tr>
	<th>
	タイトル
	</th>

<td>
	<input type="text" name="taitol" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['taitol'],ENT_QUOTES,'UTF-8'); ?>"/>
	
</td>
</tr>
<tr>
	<th>
	業務
	</th>
	<td>
	<input type="text" name="gyoumu" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['kiji'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>
<tr>
	<th>
メイン・画像
	</th>
	<td><input type="hidden" name="MAX_FILE_SIZE" value="1000">
	<input type="file" name="file" id="file"value="<?php echo htmlspecialchars($_FILES['file'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>



<tr>
	<th>
職種
	</th>
	<td>
	<input type="text" name="syokusyu" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>







<tr>
	<th>
	雇用形態
	</th>
	
<td><select  name="koyou" id="kokuseki"  maxlength="255"  value="<?php echo htmlspecialchars($_POST['kategori'],ENT_QUOTES,'UTF-8'); ?>"/>
	<OPTGROUP label="カテゴリ">
<OPTION value="All-or-Nothing">All-or-Nothing</OPTION>
<OPTION value="ALL-In">ALL-In</OPTION>

	</OPTGROUP>
</select>
	</td>
	</tr>

<tr>
	<th>
仕事内容
	</th>
	<td>
	<input type="text" name="naiyou" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>


<tr>
	<th>
給料
	</th>
	<td>
	<input type="text" name="kyuuryo" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>



<tr>
	<th>
勤務地
	</th>
	<td>
	<input type="text" name="kinmuti" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>


<tr>
	<th>
勤務地・時間
	</th>
	<td>
	<input type="text" name="jikan" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>


<tr>
	<th>
待遇
	</th>
	<td>
	<input type="text" name="taigu" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>




<tr>
	<th>
応募方法
	</th>
	<td>
	<input type="text" name="oubo" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>



<tr>
	<th>
連絡先住所
	</th>
	<td>
	<input type="text" name="renrakusaki" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>


<tr>
	<th>
連絡先TEL
	</th>
	<td>
	<input type="text" name="tel" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>



<tr>
	<th>
採用担当
	</th>
	<td>
	<input type="text" name="saiyoutantousya" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>

<tr>
	<th colspan="2">
	<input type="submit" name="submit" value="投稿"/>
	</th>
</tr>
</table>
</form>

	</section>
		</section>
 <footer class="footer">
      	<a href="https://earthintral.wordpress.com/">EARTHについて</a>&nbsp;&nbsp;
    				<a href="Terms of service.php">利用規約</a>&nbsp;&nbsp;
    				<a href="privacy.php">プライバシー</a>&nbsp;&nbsp;
				<a href=""onClick="window.alert('現在操作方法は開発中です、大変申し訳ございません')">操作方法</a>&nbsp;&nbsp;
				<a href=""onClick="window.alert('現在登録者数は開発中です、大変申し訳ございません')">登録者数</a>&nbsp;&nbsp;
			
    </footer>
</div>
</body>
</html>