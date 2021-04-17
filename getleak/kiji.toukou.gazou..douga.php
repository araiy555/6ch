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
		        echo 'upload success!';
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
		                    $message = "This format is not supported.";
		                }else{
		                    move_uploaded_file($tmp,'files/'.$random_name.'.'.$type);
		                    try{
		                         $pdo = new PDO('mysql:host=localhost; dbname=mini_bbs;','root','1234');
		                       $stmt = $pdo -> prepare ("INSERT INTO douga VALUES('','$name','files/$random_name.$type','$member_id')");
		                        $stmt -> execute();
					$douga = $pdo->lastInsertId();
		                        $message = "Succesfully Uploaded.";

		                    }catch(PDOException $e){
		                        exit('failed connecting to DB.'.$e -> getMessage());
		                    }
		                }

		                echo "$message <br/><br/>";
		            }
		       

}


if (!isset($_POST['kategori'])){
	
}
if (!isset($_POST['kiji'])){
}
if (!isset($_POST['taitol'])){
}


$pdo = new PDO('mysql:dbname=mini_bbs;host=localhost','root','1234');
$stmt = $pdo->query('SET NAMES utf8');
// TimeZoneを日本時間に設定する.phpiniにAsia/Tokyo追加
$org_timezone = date_default_timezone_get();
date_default_timezone_set('Asia/Tokyo');

$id = $member['id'];
$kategori = $_POST['kategori'];
$taitol = $_POST['taitol'];
$kiji = $_POST['kiji'];
$created = date('Y-m-d H:i:s');

if (!empty($_POST)){
	//登録処理する
	$sql = $pdo->prepare("INSERT INTO posts SET member_id=:member_id, kategori=:kategori,taitol=:taitol,kiji=:kiji, created=:created ");
	$sql->bindValue(':member_id', $id);
	$sql->bindValue(':kategori', $kategori);
	$sql->bindValue(':taitol', $taitol);
	$sql->bindValue(':kiji', $kiji);
	$sql->bindValue(':created', $created);
	$flag = $sql->execute();
	
}
?>	

<!doctype html>
<html>
<head>

<meta charset="UTF-8">
<title>EARTH</title>
</head>
<body>
    <main class="contents">
      <section class="contents__inner">
	<form action="" method="post">
<input type="hidden" name="action" value="submit"/>
	<?php echo  $kategori; ?>
	<?php echo  $taitol; ?>
	<?php echo  $kiji; ?>
		
	</section>
	
	
	<input type="submit" value="登録する"/></div>
    </main>
    <footer class="footer">
      <p>フッター</p>
    </footer>

</body>
</html>

