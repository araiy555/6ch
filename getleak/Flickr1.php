<?php

    //ライブラリを読み込む
    require_once 'phpflickr-master/phpFlickr.php';

    // Consumer Key
    $app_key = '8f4ce2545342209bedc64bd09925fdc4';

    // Consumer Secret
    $app_secret = '9ddb3a0043483a11';

    // 保存先フォルダ名
    $dir_name = "flickrImg";

    // 保存先ディレクトリがなければ作る
    if(!file_exists($dir_name)) mkdir($dir_name);

    // インスタンスを作成する
    $flickr = new phpFlickr( $app_key , $app_secret ) ;

    //オプションの設定
    $option = array(
        'text' => '猫' ,           　// 検索ワードの指定
        'media' => 'photos',        // 画像指定
        'per_page' => 20 ,          // 取得件数
        'extras' => 'url_q,url_c' , // 画像サイズ
        'safe_search' => 1 ,        // セーフサーチ
    ) ;

    // 検索を実行し、取得したデータを[$result]に代入する
    $result = $flickr->photos_search( $option ) ;

    // 画像ダウンロード
    foreach($result['photo'] as $photo)
    {
        // 写真url作成
        $url = "http://farm{$photo['farm']}.staticflickr.com/{$photo['server']}/{$photo['id']}_{$photo['secret']}.jpg";
        $data = file_get_contents($url);
        $save_path = "./{$dir_name}/{$photo['id']}.jpg";
        file_put_contents($save_path, $data);
    }
?>