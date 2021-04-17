<?php


$count = count($_FILES['files']['tmp_name']);
$errmsg = ""; // エラーメッセージ
$gazou = [];
$imageset = 0;
$dougaset = 0;

try {

    for ($i = 0; $i < $count; $i++) {
        //ファイル名の取得
        $file_name = $_FILES["files"]["type"][$i];
        //preg_match関数で判別するファイルの拡張子に「jpg」「jpeg」「png」「gif」が含まれているか確認する
        if ($_FILES["files"]["error"][$i] !== 4) {
            switch ($file_name) {
                case 'image/png':
                    $imagecount = $imageset + 1;
                    break;
                case 'image/jpeg':
                    $imagecount = $imageset + 1;
                    break;
                case 'image/jpg':
                    $imagecount = $imageset + 1;
                    break;
                case 'video/mp4':
                    $dougaset = $dougaset + 1;
                    $dougacount = $dougaset;
                    break;
                default:
                    $error = "$i'.枚目 拡張子は「jpg」「jpeg」「png」「mp4」です。</br>";
                    break;
            }
        }
    }
    if ($dougacount >= 1 AND $imagecount >= 1) {
        $error = "画像か動画のアップロードどちらかを設定してください。";
    }
    if ($dougacount >= 2) {
        $error = "動画は１つのみです。";
    }
//エラー処理
    if (empty($error)) {

//動画アップロード
        if ($dougacount == 1) {
            $file_nm = $_FILES['files']['name'][0];
            $tmp_ary = explode('.', $file_nm);
            $extension = $tmp_ary[count($tmp_ary) - 1];

            if ($extension == 'mp4') {

                $size = $_FILES['files']['size'][0];
                //30MB
                $san = '125829120';
                if ($size < $san) {
                    //$pdo = new PDO('mysql:dbname=mini_bbs;host=localhost','root','1234');
                    $pdo = new PDO('mysql:dbname=earthwork_sample;host=mysql5027.xserver.jp', 'earthwork_arai',
                        'q1w2e3r4');
                    $name = $_FILES['files']['name'][0];
                    $type = explode('.', $name);
                    $type = end($type);
                    $size = $_FILES['files']['size'][0];
                    $tmp = $_FILES['files']['tmp_name'][0];
                    $random_name = rand();

                    move_uploaded_file($tmp, 'files/' . $random_name . '.' . $type);

                    $stmt = $pdo->prepare("INSERT INTO douga VALUES('','$name','files/$random_name.$type','')");
                    $stmt->execute();

                    $douga = $pdo->lastInsertId();

                    $stmt = $pdo->query("select * from douga where id = " . "$douga");

                    $result = $stmt->fetch();
                    ?>
                    <input type="hidden" id="result1" name="" value="<?php echo $douga; ?>">
                    <video src="<?php echo $result['raw_data']; ?>" width="50%" height="50%" poster="thumb.jpg"
                           controls></video>
                    <?php
                } else {
                    $error = "ファイルサイズが大きすぎます。";
                    echo $error;
                    exit;
                }

            }

        }

//画像アップロード
        if ($imagecount > 0) {
            for ($i = 0; $i < $count; $i++) {
                $size = $_FILES['files']['size'][$i];
                if ($size < 20000) {

                    $tmp = $_FILES["files"]["tmp_name"][$i];
                    $fp = fopen($tmp, 'rb');
                    $data = bin2hex(fread($fp, $size));
                    //$pdo = new PDO('mysql:dbname=mini_bbs;host=localhost','root','1234');
                    $pdo = new PDO('mysql:dbname=earthwork_sample;host=mysql5027.xserver.jp', 'earthwork_arai',
                        'q1w2e3r4');

                    //$dsn='mysql:host=localhost;dbname=mini_bbs';
                    $dsn = 'mysql:host=mysql5027.xserver.jp;dbname=earthwork_sample';

                    $pdo->exec("INSERT INTO `upload`(`type`,`data`) values ('$type',0x$data)");
                    $gazou[] = $pdo->lastInsertId();
                    $pdo = null;
                } else {
                    $error = "画像は20KB以内です。";
                    echo $error;
                    exit;
                }
            }
            $color = implode(",", $gazou);

            //$pdo = new PDO('mysql:dbname=mini_bbs;host=localhost','root','1234');
            $pdo = new PDO('mysql:dbname=earthwork_sample;host=mysql5027.xserver.jp', 'earthwork_arai', 'q1w2e3r4');
            $images = $pdo->query("select * from upload where id IN (" . $color . ")");

            if (!empty($images)):
                foreach ($images as $i => $img):
                    if ($i):
                    endif;

                    ?>
                    <li id="<?php echo $img['id']; ?>">
                        <input type="hidden" id="result" name="" value="<?php echo $color ?>">
                        <img src="data:image/jpeg;base64,<?= base64_encode($img['data']) ?>" width="10%" height="10%"
                             class="img">
                    </li>
                <?php

                endforeach;
            endif;


        }
    } else {
        echo $error;
        exit;
    }
} catch (PDOException $e) {
    // 500 Internal Server Errorでテキストとしてエラーメッセージを表示
    http_response_code(500);
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}
?>
