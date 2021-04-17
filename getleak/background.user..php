
<?php
$id =  $_REQUEST['id'];
$sql = "select member_id from background where member_id='$id' ORDER BY modified DESC LIMIT 1" ;
  $error = mysql_query($sql) or die(mysql_error());
?>
<?php

try {

$id =  $_REQUEST['id'];
		$background = $pdo->query("select * from background where member_id='$id' ORDER BY modified DESC LIMIT 1");
} catch (PDOException $e) {
		// 500 Internal Server Errorでテキストとしてエラーメッセージを表示
http_response_code(500);
header('Content-Type: text/plain; charset=UTF-8', true, 500);
		exit($e->getMessage());


}

// HTMLとして表示 (文字コードもここで指定するために上書きする)
header('Content-Type: text/html; charset=UTF-8');

?>
<?php

$kml = mysql_num_rows($error);

if($kml == 0){

			echo "<img class='img-thumbnail' src='img/noimage.png' class='rounded-circle z-depth-1' width='50%' style='border-radius: 50px;' alt='読み込み中…'>";

}else{


}
?>
