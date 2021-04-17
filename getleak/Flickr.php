
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="EARTHは、同じ職業の人たちと交流を深めることのできるソーシャルユーティリティサイトです。EARTHを利用すれば、同じ職業の人と質問し合い最新の情報をチェックしたり、写真をアップロードしたり(枚数は無制限)、リンクや動画を投稿したり、新たな可能性を.">
	<title>EARTH</title>
	<link rel="stylesheet" type="text/css" href="サーチ.css">



  </head>
  <body>

<?php

session_start();
header('Expires: -1');
header('Cache-Control:');
header('Pragma:');
require('dbconnect.php');


$name =  $_REQUEST['id'];


$sql = "SELECT id, simei,name,job,tosi,kokuseki,message,seibetu FROM members WHERE simei like '%{$name}%' ORDER BY created DESC LIMIT 10" ;
  $record = mysql_query($sql) or die(mysql_error());
?>





<div class="wrapper">
    <header class="header">
      	<section class="earth1">

		<a href="taitol.php"><img src="img/EARTH4.png" width="180" height=40" alt="EARTH"></a>
     		</section>
	
	<section class="earth2">
<form action="searth.php" name="search1" method="post">
	<dl class="search1" >
		<dt><input type="text" name="search" value="<?php echo $name;?>" placeholder="Earthの検索またはチャンネル" autocomplete="off"/></dt>
		<dd><button><span></span></button></dd>
	</dl>
	</form>


</section>
<section class="earth3">
<a href="login.php" ><img src="img/user.png" alt="<?php echo $member['simei']; ?><?php echo $member['name']; ?>"  title="<?php echo $member['simei']; ?><?php echo $member['name']; ?>" style="border-radius: 100px;"  align="middle"width="4%" height="5%" vspace="10"hspace="5"></a>


</section>

   </header>

<main class="contents">
<div id="menu">
<ul>
<li><a href="google.php?id=<?php echo $name; ?>">検索</a></li>
<li><a href="sured.php?id=<?php echo $name; ?>">スレッド</a></li>
<li><a href="google.news.php?id=<?php echo $name; ?>">ニュース</a></li>
<li><a href="jinbutu.php?id=<?php echo $name; ?>">チャンネル</a></li>

<li><a href="flickr.php?id=<?php echo $name; ?>">写真</a></li>
<li><a href="#">動画</a></li>
<li><a href="#">質問</a></li>
<li><a href="phpquery/amazon.php?id=<?php echo $name; ?>">ショッピング</a></li>
<li><a href="ibent.php?id=<?php echo $name; ?>">イベント</a></li>
<li><a href="hotppper/index.php?id=<?php echo $name; ?>">レストラン</a></li>


</ul> 
</div>


      <section class="contents__inner1">

<?php


		$name = $_REQUEST['id'];
 
	//ライブラリを読み込む
	require_once 'phpflickr-master/phpFlickr.php' ;

	// Consumer Key
	$app_key = '8f4ce2545342209bedc64bd09925fdc4' ;

	// Consumer Secret
	$app_secret = '9ddb3a0043483a11' ;

	// インスタンスを作成する
	$flickr = new phpFlickr( $app_key , $app_secret ) ;

	//オプションの設定
	$option = array(
		'text' => $_REQUEST['id'] ,		// 検索ワードの指定
		'per_page' => 80 ,			// 取得件数
		'extras' => 'url_q,url_c' , 		// 画像サイズ
		'safe_search' => 1 ,		// セーフサーチ
	) ;

	// GETメソッドで指定がある場合
	foreach( array( 'text' , 'per_page' , 'woe_id' , 'license' , 'sort' , 'bbox' ) as $val )
	{
		if( isset( $_GET[ $val ] ) && $_GET[ $val ] != '' )
		{
			$option[ $val ] = $_GET[ $val ] ;
		}
	}

	// 検索を実行し、取得したデータを[$result]に代入する
	$result = $flickr->photos_search( $option ) ;

	// [$result]をJSONに変換する
	$json = json_encode( $result );

	// JSONをオブジェクト型に変換する
	$obj = json_decode( $json ) ;

	// HTML用
	$html = '' ;

	// 写真検索を実行する
	//$html .= '<h2>条件を指定する</h2>' ;
	//$html .= '<p>条件を指定して、写真を検索してみて下さい。</p>' ;
	//$html .= '<form>' ;
	//$html .= 	'<p style="font-size:.9em; font-weight:700;"><label for="text">検索キーワード (text)</label></p>' ;
	//$html .= 		'<p style="margin:0 0 1em;"><input id="text" name="text" value="" placeholder=""></p>' ;
	//$html .= 	'<p style="font-size:.9em; font-weight:700;"><label for="bbox">位置範囲 (bbox)</label></p>' ;
	//$html .= 		'<p style="margin:0 0 1em;"><input id="bbox" name="bbox" list="bbox-data" placeholder=""></p>' ;
	//$html .= 		'<datalist id="bbox-data">' ;
	//$html .= 			'<option value="139.74136476171873,35.67800739824976,139.78565339697263,35.71146639304908">' ;
	//$html .= 		'</datalist>' ;
	//$html .= 	'<p><button>検索する</button></p>' ;
	//$html .= '</form>' ;

	// 実行結果の表示
	$html .= '<h2>実行結果</h2>' ;
	$html .= '<p>リクエストの実行結果です。</p>' ;

	// リスト形式で表示する
	$html .= '<ul style="margin:2em 0 0; padding:0; overflow:hidden; list-style-type:none; text-align:center;">' ;

	// ループ処理
	foreach( $obj->photo as $photo )
	{
		// データが揃っていない場合はスキップ
		if( !isset($photo->url_q) || !isset($photo->width_q) || !isset($photo->height_q) )
		{
			continue ;
		}

		// データの整理
		$t_src = $photo->url_q ;		// サムネイルの画像ファイルのURL
		$t_width = $photo->width_q ;	// サムネイルの横幅
		$t_height = $photo->height_q ;	// サムネイルの縦幅
		$o_src = ( isset($photo->url_c) ) ? $photo->url_c : $photo->url_q ;		// 画像ファイルのURL

		// 出力する
		$html .= '<li style="float:left; margin:1px; padding:0; overflow:hidden; height:112.5px">' ;
		$html .= 	'<a href="' . $o_src . '" target="_blank">' ;
		$html .= 		'<img src="' . $t_src . '" width="' . $t_width . '" height="' . $t_height . '" style="max-width:100%; height:auto">' ;
		$html .= 	'</a>' ;
		$html .= '</li>' ;
	}

	$html .= '</ul>' ;

	// 取得したデータ
	//$html .= '<h2>取得したデータ</h2>' ;
	//$html .= '<p>下記のデータを取得できました。</p>' ;
	//$html .= 	'<h3>JSONに変換後</h3>' ;
	//$html .= 	'<p><textarea rows="8">' . $json . '</textarea></p>' ;

?>

<?php
	// ブラウザに[$html]を出力 (HTMLのヘッダーとフッターを付けましょう)
	echo $html ;
?>



    </section>
</main>

<footer class="footer">
      <p>フッター</p>
    </footer>
</body>
</html>