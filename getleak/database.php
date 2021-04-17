<?php

function select($sql,$value){
try {
    $pdo = new PDO('mysql:dbname=earthwork_sample;host=mysql5027.xserver.jp','earthwork_arai','q1w2e3r4');
    $stmt = $pdo->prepare($sql);
    //executeメソッドに配列を渡す。
    $stmt->execute($value);
    //結果を表示
    $result = $stmt->fetch();
    return $result;
} catch (PDOException $e) {
    echo 'データベース接続エラー';
}
}

function viewcount($sql,$value){
    try {
        $pdo = new PDO('mysql:dbname=earthwork_sample;host=mysql5027.xserver.jp','earthwork_arai','q1w2e3r4');
        $stmt = $pdo->prepare($sql);
        //executeメソッドに配列を渡す。
        $stmt->execute($value);
        //結果を表示
        $result = $stmt->fetch();
        return $result;
    } catch (PDOException $e) {
        echo 'データベース接続エラー';
    }
}


//
//$sql = 'select count(*) as cnt from saiseisu where saisei_id = ?';
//$value = array(1);
//select($sql,$value);
