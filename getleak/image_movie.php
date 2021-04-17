<?php


$count = count($_FILES['files']['tmp_name']);
$errmsg = ""; // エラーメッセージ
$gazou = [];
for ($i = 0 ; $i < $count ; $i ++ ) {

  //ファイル名の取得
   $file_name = $_FILES["files"]["type"][$i];

  //preg_match関数で判別するファイルの拡張子に「jpg」「jpeg」「png」「gif」が含まれているか確認する
  if ($_FILES["files"]["error"][$i] !== 4) {
  switch ($file_name) {
    case 'image/png':
    break;
    case 'image/jpeg':
    break;
    case 'image/jpg':
    break;
    case 'video/mp4':
    break;
    default:

    $error = "$i'.枚目 拡張子は「jpg」「jpeg」「png」「mp4」です。</br>";
    break;
  }
}

if(empty($error)){

  $type = $_FILES["files"]["type"][$i];
  $size = $_FILES['files']['size'][$i];
  $tmp = $_FILES["files"]["tmp_name"][$i];

  $fp = fopen($tmp,'rb');
  $data = bin2hex(fread($fp,$size));
  //$pdo = new PDO('mysql:dbname=mini_bbs;host=localhost','root','1234');
  $pdo = new PDO('mysql:dbname=earthwork_sample;host=mysql5027.xserver.jp','earthwork_arai','q1w2e3r4');

  //$dsn='mysql:host=localhost;dbname=mini_bbs';
  $dsn='mysql:host=mysql5027.xserver.jp;dbname=earthwork_sample';

  $pdo->exec("INSERT INTO `upload`(`type`,`data`) values ('$type',0x$data)");
  $gazou[] = $pdo->lastInsertId();
  $pdo = null;
}else{

      echo $error;
$error = '';
}

}

//print_r($gazou);
//配列を文字列に変換してテーブルに登録しています。
 $color = implode(",",$gazou);
 ?>

<?php
try {

  //$pdo = new PDO('mysql:dbname=mini_bbs;host=localhost','root','1234');
  $pdo = new PDO('mysql:dbname=earthwork_sample;host=mysql5027.xserver.jp','earthwork_arai','q1w2e3r4');

$images = $pdo->query("select * from upload where id IN (".$color.")");

} catch (PDOException $e) {
// 500 Internal Server Errorでテキストとしてエラーメッセージを表示
http_response_code(500);
header('Content-Type: text/plain; charset=UTF-8', true, 500);
exit($e->getMessage());
}
?>


                      <?php

 if (!empty($images)):
 foreach ($images as $i => $img):
if ($i):
 endif;
?>

<li id="<?php echo $img['id'];?>" >
  <input type="hidden" id="result" name="" value="<?php echo $color?>">
  <img src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>"width="10%" height="10%" class="img">
</li>





<?php
endforeach;
endif;
?>

<?php
// ファイルのアップロード
// if($file > 0){
// foreach ($_FILES["upfile"]["error"] as $key => $value) {
//
// if (is_uploaded_file($_FILES["upfile"]["tmp_name"][$key])) {
// // ファイルが選択されている場合拡張子チェック
// $fileType = pathinfo($_FILES["upfile"]["name"][$key], PATHINFO_EXTENSION);
//
// if ($fileType == 'gif' || $fileType == 'jpg' || $fileType == 'png') {
// // 拡張子がpdfまたはjpgまたはpngの場合ファイルサイズチェック
// if ($_FILES['upfile']['size'][$key] < 2097152) {
//     echo 'ok!'
//     } else {
//     //  echo 'ファイルサイズが大きすぎます！';
//     exit;
// }
// } else {
// // pdf jpg png 以外の場合
// //echo "拡張子はpdf,jpg,pngです！！！";
// exit;
// }
// } else {
// // ファイルが選択されていない場合
// //echo "ファイルが選択されていません。";
// exit;
// }
// }


?>
