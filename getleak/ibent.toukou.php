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

<?php


$taitol = $_POST['taitol'];
$basyo = $_POST['basyo'];

$kaisi = $_POST['kaisi'];
$kaisijikan = $_POST['kaisijikan'];
$syuuryou = $_POST['syuuryou'];
$syuuryoujikan = $_POST['syuuryoujikan'];
$syousai = $_POST['syousai'];
$keeward = $_POST['keeward'];
$url = $_POST['url'];
$syusaisya = $_POST['syusaisya'];


	$file = $_FILES["file"]["error"];
	//入力チェック
	$errormsg = array();
	//名前
	
	if ($taitol == null) {
		$errormsg[] = "タイトルを入力してください。";
	}
	if (mb_strlen($taitol) > 30) {
		$errormsg[] = "タイトルは30文字以内で入力して下さい。";
	}
	//内容
	if ($basyo == null) {
		$errormsg[] = "記事を入力して下さい。";
	}
	if ($file == 1) {
		$errormsg[] = "サイズが大きいです。";
	}
		if ($file == 2) {
		$errormsg[] = "アップロードしているファイルは有効な動画ファイルではない可能性があります。アップロードの推奨ファイル形式をご覧ください。";
	}
		if ($file == 3) {
		$errormsg[] = "一部のみしかアップロードされませんでした。";
	}
		if ($file == 6) {
		$errormsg[] = "サーバー一時保管フォルダがありません。";
	}
	
		if ($file == 7) {
		$errormsg[] = "ディスクの書き込みに失敗しました。";
	}
		if ($file == 8) {
		$errormsg[] = "PHPの拡張モジュールがアップロードを中止した";
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="EARTHは、同じ職業の人たちと交流を深めることのできるソーシャルユーティリティサイトです。EARTHを利用すれば、同じ職業の人と質問し合い最新の情報をチェックしたり、写真をアップロードしたり(枚数は無制限)、リンクや動画を投稿したり、新たな可能性を.">
	<title>EARTH</title>
<style TYPE="text/css">
	<!--
		H1 {
			color: red;
			font-size: 18pt;
		}
		#contact-form th {
			background-color: #9bdbea;
			padding: 10px 20px;
		}
		#contact-form td {
			background-color: #f7f7ef;
			padding: 10px 20px;
		}
		#contact-form td input {
			width: 400px;
		}
		#contact-form td textarea {
			width: 400px;
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
			padding:10px;
			text-align:left;
			width:400px;
		}
	-->
	</style>


</head>
<body>

<?php if (count($errormsg) > 0): ?>
<div id="errmsg">
<?php foreach ($errormsg as $msg): ?>
	・<?=$msg?><br />
<?php endforeach; ?>

</div>
  
     <form action="ibent.toukou.php" method="post" enctype="multipart/form-data">
	<table id="contact-form" border="1" cellpadding="0" cellspacing="0">
<tr>
	<th>
イベントの写真
	</th>
	<td><input type="hidden" name="MAX_FILE_SIZE" value="1000">
	<input type="file" name="file" id="file"value="<?php echo htmlspecialchars($_FILES['file'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>















<tr>
	<th>
イベント名
	</th>
	<td>
	<input type="text" name="taitol" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>



<tr>
	<th>
場所
	</th>
	<td>
	<input type="text" name="basyo" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>


<tr>
	<th>
開始日時
	</th>
	<td>
	<input type="text" name="kaisi" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	<input type="text" name="kaisijikan" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>


	</td>
</tr>


<tr>
	<th>
終了日時
	</th>
	<td>
	<input type="text" name="syuuryou" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	<input type="text" name="syuuryoujikan" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>

	</td>
</tr>




<tr>
	<th>
詳細
	</th>
	<td>
	<input type="text" name="syousai" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>



<tr>
	<th>
キーワード
	</th>
	<td>
	<input type="text" name="keeward" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>


<tr>
	<th>
チケットURL
	</th>
	<td>
	<input type="text" name="url" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>



<tr>
	<th>
共同主催者
	</th>
	<td>
	<input type="text" name="syusaisya" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['honbun'],ENT_QUOTES,'UTF-8'); ?>"/>
	</td>
</tr>
<tr>
	<th colspan="2">
	<input type="submit" name="submit" value="OK"/>
	</th>
</tr>
</table>
</form>

<?php else: ?>





<?php



    $file_nm = $_FILES['file']['name'];
    $tmp_ary = explode('.', $file_nm);
    $extension = $tmp_ary[count($tmp_ary)-1];
    echo($extension);//ここで拡張子を表示している
    /* ファイルアップロードがあったとき */
 		
      ob_start();
      //トランザクション処理を開始
      
	
if($extension == 'jpg' || $extesion == 'JPG'){
		
		if ($_FILES["file"]["error"] > 0){
		    echo "ファイルエラー: " . $_FILES["file"]["error"] . "<br />";
		}
		 // バッファリングを開始
		
		else{
		    $type = $_FILES["file"]["type"];
		    $size = $_FILES['file']['size'];
		    $tmp=$_FILES["file"]["tmp_name"];
		    $fp = fopen($tmp,'rb');
		    $data = bin2hex(fread($fp,$size));
		    $dsn='mysql:host=localhost;dbname=mini_bbs';
			$member_id = $member['id'];		
		    echo '<pre>';
		    try{
		        $pdo = new PDO($dsn,'root','1234');
		        $pdo->exec("INSERT INTO `upload`(`type`,`data`,`member_id`) values ('$type',0x$data,'$member_id')");
		        $gazou = $pdo->lastInsertId();
		        echo 'アップロードが完了しました。';
		        $pdo = null;
		    }catch (PDOException $e){
		        echo $e->getMessage();
		    }
		    echo '</pre>';
		    fclose($fp);
		}
	
}

if($extension == 'mp4'){
	
		 if(isset($_FILES['file'])){

		                $name = $_FILES['file']['name'];
		                $type = explode('.',$name);
		                $type = end($type);
		                $size = $_FILES['file']['size'];
		                $tmp = $_FILES['file']['tmp_name'];
		                $random_name = rand();
				$member_id = $member['id'];
		                if($type != 'mp4' && $type != 'MP4'){
		                    $message = "拡張子が間違えています。.";
		                }else{
		                    move_uploaded_file($tmp,'files/'.$random_name.'.'.$type);
		                    try{
		                         $pdo = new PDO('mysql:host=localhost; dbname=mini_bbs;','root','1234');
		                       $stmt = $pdo -> prepare("INSERT INTO douga VALUES('','$name','files/$random_name.$type','$member_id')");
		    			$stmt -> execute();
					 $douga = $pdo->lastInsertId();
					$message = "アップロードしました。.";
					
		                    }catch(PDOException $e){
		                        exit('failed connecting to DB.'.$e -> getMessage());
		                    }
		                }

		                echo "$message <br/><br/>";
		            
		                       
			}
		       

}




if (!isset($_POST['taitol'])){
}

if (!isset($_POST['basyo'])){
}

if (!isset($_POST['kaisi'])){
}
if (!isset($_POST['kaisijikan'])){
}
if (!isset($_POST['syuuryou'])){
}
if (!isset($_POST['syuuryoujikan'])){
}
if (!isset($_POST['syousai'])){
}
if (!isset($_POST['keeward'])){
}
if (!isset($_POST['url'])){
}
if (!isset($_POST['syusaisya'])){
}



$pdo = new PDO('mysql:dbname=mini_bbs;host=localhost','root','1234');
$stmt = $pdo->query('SET NAMES utf8');
// TimeZoneを日本時間に設定する.phpiniにAsia/Tokyo追加
$org_timezone = date_default_timezone_get();
date_default_timezone_set('Asia/Tokyo');

$id = $member['id'];

$taitol = $_POST['taitol'];
$basyo = $_POST['basyo'];

$kaisi = $_POST['kaisi'];
$kaisijikan = $_POST['kaisijikan'];
$syuuryou = $_POST['syuuryou'];
$syuuryoujikan = $_POST['syuuryoujikan'];
$syousai = $_POST['syousai'];
$keeward = $_POST['keeward'];
$url = $_POST['url'];
$syusaisya = $_POST['syusaisya'];

$created = date('Y-m-d H:i:s');

if (!empty($_POST)){
	//登録処理する
	$sql = $pdo->prepare("INSERT INTO ibent SET member_id=:member_id, taitol=:taitol,basyo=:basyo,kaisi=:kaisi,kaisijikan=:kaisijikan,syuuryou=:syuuryou,syuuryoujikan=:syuuryoujikan,syousai=:syousai,keeward=:keeward,url=:url,syusaisya=:syusaisya,created=:created,dougaid=:dougaid,gazouid=:gazouid ");
	$sql->bindValue(':member_id', $id);
	$sql->bindValue(':taitol', $taitol);
	$sql->bindValue(':basyo', $basyo);

	$sql->bindValue(':kaisi', $kaisi);
	$sql->bindValue(':kaisijikan', $kaisijikan);
	$sql->bindValue(':syuuryou', $syuuryou);
	$sql->bindValue(':syuuryoujikan', $syuuryoujikan);
	$sql->bindValue(':syousai', $syousai);
	$sql->bindValue(':keeward', $keeward);
	$sql->bindValue(':url', $url);
	$sql->bindValue(':syusaisya', $syusaisya);

	$sql->bindValue(':created', $created);
	$sql->bindValue(':dougaid', $douga);
		$sql->bindValue(':gazouid', $gazou);
	$flag = $sql->execute();
	
}
?>	



<table id="contact-form" border="1" cellpadding="0" cellspacing="0">





		<tr>
		<th>
			カテゴリ
		</th>
		<td>
			<?php echo  $kategori; ?>
		</td>
	</tr>

	<tr>
		<th>
			タイトル
		</th>
		<td>
			<?php echo  $taitol; ?>
		</td>
	</tr>

	<tr>
		<th>
			内容
		</th>
		<td>
		
	<?php echo  $kiji; ?>
		</td>
	</tr>
	<tr>
		<th>
			画像・動画
		</th>
		<td>
		<?php echo $douga; ?>
		<?php echo $gazou; ?>
		
		</td>
	</tr>


	<tr>
		<th colspan="2">
			<form action="main.php" method="post"enctype="multipart/form-data">
				<input type="hidden" name="kategori" value="<?php echo htmlspecialchars($_POST['kategori'],ENT_QUOTES,'UTF-8'); ?>">
				<input type="hidden" name="taitol" value="<?php echo htmlspecialchars($_POST['taitol'],ENT_QUOTES,'UTF-8'); ?>">
				<input type="hidden" name="kiji" value="<?php echo htmlspecialchars($_POST['kiji'],ENT_QUOTES,'UTF-8'); ?>">
				<input type="hidden" name="file"id="file" value="<?php echo htmlspecialchars($_FILES['file'],ENT_QUOTES,'UTF-8'); ?>">
				<input type="submit" value="戻る"/></div>
			</form>
			
		</th>
	</tr>
</table>
<?php endif; ?>
</body>
</html>