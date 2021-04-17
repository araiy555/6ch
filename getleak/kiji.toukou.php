
<?php
require('dbconnect.php');

$data = $_POST;
//
$error_count = 0;
//
$error = array();

if (!empty($data)) {
	//エラー項目の確認
  //名前
  if (mb_strlen($data['title']) > 50) {
    $error_count = $error_count + 1;
    $error = 'タイトルは50文字以内で入力してください';
  }
	else if ($data['kokuseki'] == ''){
    $error_count = $error_count + 1;
    $error = 'カテゴリを入力してださい';
  }
	else if($data['tag'] == ''){
    $error_count = $error_count + 1;
    $error = 'タグを入力してください';
	}
	else if($data['editor'] == ''){
    $error_count = $error_count + 1;
    $error = '内容を入力してください';
}else if($data['title'] == ''){
  $error_count = $error_count + 1;
  $error = 'タイトルを入力してください';
}

}

//内容に問題があった場合の処理
if ($error_count > 0) {
  echo $error;
}else {
    // TimeZoneを日本時間に設定する.phpiniにAsia/Tokyo追加
    $org_timezone = date_default_timezone_get();
    date_default_timezone_set('Asia/Tokyo');
    if($data['member_id']){
      $id = $data['member_id'];
    }else{
      $id = 1;
    }

    $kategori = $data['kokuseki'];
    $taitol = $data['title'];
    $tags = $data['tag'];
    $created = date('Y-m-d H:i:s');
    $value = htmlspecialchars($data["editor"]);

    if ($data['image']) {
     $file = $data['image'];
    }else {
     $file = $data['image1'];
    }
    if ($data['douga']) {
    $douga = $data['douga'];
  }

    if (!empty($data)) {
    //登録処理する
    $sql = $pdo->prepare("INSERT INTO posts SET member_id=:member_id, kategori=:kategori,taitol=:taitol,created=:created,gazouid=:gazouid,dougaid=:dougaid,editor=:value,tag=:tags ");
    $sql->bindValue(':member_id', $id);
    $sql->bindValue(':kategori', $kategori);
    $sql->bindValue(':taitol', $taitol);
    $sql->bindValue(':created', $created);
    $sql->bindValue(':value', $value);
      $sql->bindValue(':gazouid', $file);
      $sql->bindValue(':dougaid', $douga);
    $sql->bindValue(':tags', $tags);
    $flag = $sql->execute();
    }
    //登録結果処理
    if ($flag =='1') {
      echo '登録が完了しました。';
    }else{
      echo 'システムに問題が発生しました。';
    }
}
exit;
