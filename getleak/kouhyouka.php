

<?php


if (!isset($_REQUEST['id'])){
	header('Location: date.php');
}



$pdo = new PDO('mysql:dbname=mini_bbs;host=localhost','root','1234');
$stmt = $pdo->query('SET NAMES utf8');


$hyouka_id = $_REQUEST['id'];



	//登録処理する
	$sql = $pdo->prepare("INSERT INTO kouhyouka SET hyouka_id=:hyouka_id");
	$sql->bindValue(':hyouka_id', $hyouka_id);

	
	$flag = $sql->execute();
	
	header("Location: searth.following.toukou.php?id=".$hyouka_id."");

exit();
?>