
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
</br>
</br>
</br>

</section>
<section class="katego">
<p><a href='users.php'>すべて</p>&nbsp;&nbsp;
<p><a href='google.php?id=<?php echo $name; ?>'>検索</p>&nbsp;&nbsp;
<p><a href='sured.php?id=<?php echo $name; ?>'>スレッド</p>&nbsp;&nbsp;
<p><a href='google.news.php?id=<?php echo $name; ?>'>ニュース</p>&nbsp;&nbsp;
<p><a href='users.php'>チャンネル</p>&nbsp;&nbsp;
<p><a href='wikisearch.php?id=<?php echo $name; ?>'>wiki</p>&nbsp;&nbsp;
<p><a href='flickr.php?id=<?php echo $name; ?>'>写真</p>&nbsp;&nbsp;
<p><a href='users.php'>動画</p>&nbsp;&nbsp;

<p><a href='users.php'>依頼</p>&nbsp;&nbsp;

<p><a href='users.php'>音楽</p>&nbsp;&nbsp;
<p><a href='phpquery/amazon.php?id=<?php echo $name; ?>'>ショッピング</p>&nbsp;&nbsp;

<p><a href='users.php'>ランキング</p>&nbsp;&nbsp;
<p><a href='users.php'>グラフ</p>&nbsp;&nbsp;
<p><a href='users.php'>設定</p>&nbsp;&nbsp;
</section>

   </header>


<main class="contents">
      <section class="contents__inner1">


<?php
$aws_access_key_id = 'AKIAJLSOASUCEVXNBCWA';
$aws_secret_key = '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';
$AssociateTag='ni0c8-22';

//URL生成
$endpoint = 'webservices.amazon.co.jp';
$uri = '/onca/xml';

for($i=1; $i<=2; $i++){//2ページ取得、ItemSearchの最大値は10まで
	//パラメータ群
	$params = array(
		'Service' => 'AWSECommerceService',
		'Operation' => 'ItemSearch',
		'AWSAccessKeyId' => $aws_access_key_id,
		'AssociateTag' => $AssociateTag,
		'SearchIndex' => 'Books',
		'ResponseGroup' => 'Medium',
		'Keywords' => '進撃の巨人',
		'ItemPage' => $i
	);

	//timestamp
	if (!isset($params['Timestamp'])) {
		$params['Timestamp'] = gmdate('Y-m-d\TH:i:s\Z');
	}

	//パラメータをソート
	ksort($params);

	$pairs = array();
	foreach ($params as $key => $value) {
		array_push($pairs, rawurlencode($key).'='.rawurlencode($value));
	}

	//リクエストURLを生成
	$canonical_query_string = join('&', $pairs);
	$string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;
	$signature = base64_encode(hash_hmac('sha256', $string_to_sign, $aws_secret_key, true));
	$request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);

	$amazon_xml=simplexml_load_string(@file_get_contents($request_url));//@はエラー回避

	foreach($amazon_xml->Items->Item as $item_a=>$item){
		$detailURL=$item->DetailPageURL;//商品のURL
		$image=$item->MediumImage->URL;//画像のURL
		$title=$item->ItemAttributes->Title;//商品名
		$author=$item->ItemAttributes->Author;//著者名
		$price=$item->ItemAttributes->ListPrice->Amount;//価格

		print '<div style="clear:both; margin-bottom:20px;"><a href="'.$detailURL.'" target="_blank"><img src="'.$image.'" align="left"></a><br>
タイトル：<a href="'.$detailURL.'" target="_blank">'.$title.'</a><br>
著者：'.$author.'<br>
価格：'.$price.'<br>
URL：'.$detailURL.'</div>';
		print PHP_EOL;
	}

	//1秒おく
	sleep(1);
}
?>
</div>
    </section>
</main>

<footer class="footer">
      <p>フッター</p>
    </footer>
</body>
</html>