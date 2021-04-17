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
	$kategori = $_POST["kategori"];
	$taitol = $_POST["taitol"];
	$URL = $_POST["URL"];
	$nedan = $_POST["nedan"];

	//入力チェック
	$errormsg = array();
	//名前
	if ($kategori == null) {
		$errormsg[] = "カテゴリを入力して下さい。";
	}
	if ($taitol == null) {
		$errormsg[] = "タイトルを入力してください。";
	}
	if (mb_strlen($taitol) > 30) {
		$errormsg[] = "タイトルは30文字以内で入力して下さい。";
	}
	if ($URL == null) {
		$errormsg[] = "URLを入力してください。";
	}

	//内容
	if ($nedan == null) {
		$errormsg[] = "記事を入力して下さい。";
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
  
     <form action="kiji.toukou.php" method="post">
	<table id="contact-form" border="1" cellpadding="0" cellspacing="0">
<tr>
	<th>
	カテゴリ
	</th>
	
<td><select  name="kategori" id="kokuseki"  maxlength="255" value="<?= $kategori ?>"/>
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
	<input type="text" name="taitol" size="35" maxlength="255" value="<?= $taitol ?>"/></li>	
	
</td>
</tr>
<tr>
	<th>
	URL
	</th>
	<td>
	<input type="text" name="URL" size="35" maxlength="255" value="<?= $URL ?>""/>
	</td>
</tr>

<tr>
	<th>
	値段
	</th>
	<td>
	<input type="text" name="nedan" size="35" maxlength="255" value="<?= $nedan ?>""/>
	</td>
</tr>


<tr>
	<th>
	動画・画像
	</th>
	<td>
		<input type="file" name="file"id="file" value="<?php echo htmlspecialchars($_FILES['file'],ENT_QUOTES,'UTF-8'); ?>">
			
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
		    echo "Error: " . $_FILES["file"]["error"] . "<br />";
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
	
}else if($extension == 'mp4'){
	
			
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


if (!isset($_POST['kategori'])){
	
}
if (!isset($_POST['URL'])){
}
if (!isset($_POST['taitol'])){
}
if (!isset($_POST['nedan'])){
}

$pdo = new PDO('mysql:dbname=mini_bbs;host=localhost','root','1234');
$stmt = $pdo->query('SET NAMES utf8');
// TimeZoneを日本時間に設定する.phpiniにAsia/Tokyo追加
$org_timezone = date_default_timezone_get();
date_default_timezone_set('Asia/Tokyo');

$id = $member['id'];
$kategori = $_POST['kategori'];
$taitol = $_POST['taitol'];
$URL = $_POST['URL'];
$nedan = $_POST['nedan'];
$created = date('Y-m-d H:i:s');

if (!empty($_POST)){
	//登録処理する
	$sql = $pdo->prepare("INSERT INTO hanbaiposts SET member_id=:member_id, kategori=:kategori,taitol=:taitol,URL=:URL,nedan=:nedan,created=:created,dougaid=:dougaid,gazouid=:gazouid ");
	$sql->bindValue(':member_id', $id);
	$sql->bindValue(':kategori', $kategori);
	$sql->bindValue(':taitol', $taitol);
	$sql->bindValue(':URL', $URL);
	$sql->bindValue(':nedan', $nedan);
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
			URL
		</th>
		<td>
		
	<?php echo  $URL; ?>
		</td>
	</tr>
	<tr>
		<th>
			値段
		</th>
		<td>
			<?php echo  $nedan; ?>
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
				<input type="hidden" name="URL" value="<?php echo htmlspecialchars($_POST['URL'],ENT_QUOTES,'UTF-8'); ?>">
				<input type="hidden" name="nedan" value="<?php echo htmlspecialchars($_POST['nedan'],ENT_QUOTES,'UTF-8'); ?>">
				<input type="hidden" name="file"id="file" value="<?php echo htmlspecialchars($_FILES['file'],ENT_QUOTES,'UTF-8'); ?>">
				<input type="submit" value="戻る"/></div>
			</form>
			
		</th>
	</tr>
</table>
<?php endif; ?>
</body>
</html>