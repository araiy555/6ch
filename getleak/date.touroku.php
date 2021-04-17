<?php
require('dbconnect.php');
$error = '';
try {
isset($_POST)? $data = $_POST : $error = 1;
$id = $data['member_id'];
$nationality = $data['nationality'];
$browser = $data['browser'];
$family_name = $data['family_name'];
$name = $data['name'];
$message = $data['self_introduction'];
$sex = $data['sex'];
$renrakubango = $data['phone_number'];
$renrakuadoresu = $data['mail_address'];
$tosi = $data['age'];
$job = $data['occupation'];
$detahenkou = date('Y-m-d H:i:s');
if (!empty($error)) {
    throw new Exception("エラーです");
}
    	//登録処理する
    	$sql = $pdo->prepare("UPDATE members SET
             simei=:family_name,
             name=:name,
             kokuseki=:nationality,
             seibetu=:sex,
             message=:message,
             renrakubango=:renrakubango,
             renrakuadoresu=:renrakuadoresu,
             detahenkou=:detahenkou,
             job=:job,
             tosi=:tosi,
             is_activate=:browser
            WHERE id=:id ");
    	$sql->bindValue(':id', $id);
        $sql->bindValue(':family_name', $family_name);
        $sql->bindValue(':name', $name);
        $sql->bindValue(':nationality', $nationality);
        $sql->bindValue(':sex', $sex);
    	$sql->bindValue(':message', $message);
    	$sql->bindValue(':renrakubango', $renrakubango);
    	$sql->bindValue(':renrakuadoresu', $renrakuadoresu);
    	$sql->bindValue(':detahenkou', $detahenkou);
    	$sql->bindValue(':tosi', $tosi);
    	$sql->bindValue(':job', $job);
        $sql->bindValue(':browser', $browser);
    $flag = $sql->execute();
        //登録結果処理
        if ($flag =='1') {
          echo '登録が完了しました。';
        }else{
          echo 'システムに問題が発生しました。';
        }
} catch (\Exception $e) {
    echo $e->getMessage();
}
exit;

?>
