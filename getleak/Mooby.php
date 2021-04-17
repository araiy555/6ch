<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
<body>
<?php
require_once("phpQuery-onefile.php");
 
// HTMLデータを取得する
$HTMLData = file_get_contents('https://news.yahoo.co.jp/');
// HTMLをオブジェクトとして扱う
$phpQueryObj = phpQuery::newDocument($HTMLData);
 
// h1タグを片っ端からぶん回す
foreach($phpQueryObj['body'] as $val) {
  // 連続実行すると怒られちゃうのでとりあえず5秒待機
  sleep(5);
 
  // pq()メソッドでオブジェクトとして再設定しつつさらに下ってhrefを取得
  $title = pq($val)->find('a')->text();
  $url = pq($val)->find('a')->attr('href');
  echo 'IT・科学ニュース - Yahoo!ニュース：' . $title . PHP_EOL;
  echo 'https://news.yahoo.co.jp/hl?c=c_sci：'. $url . PHP_EOL;
	echo "<br><br>";
  getChiledPage($url);
 
  echo PHP_EOL.PHP_EOL;
}

foreach ($phpQueryObj->find('img') as $img){
    $src = $img->getAttribute('src');
    echo $src,'<br>';   

}

// h1タグを片っ端からぶん回す
foreach($phpQueryObj['href'] as $val) {
  // 連続実行すると怒られちゃうのでとりあえず5秒待機
  sleep(5);
 
  // pq()メソッドでオブジェクトとして再設定しつつさらに下ってhrefを取得
  $title = pq($val)->find('a')->text();
  $url = pq($val)->find('a')->attr('href');
  echo 'IT・科学ニュース - Yahoo!ニュース：' . $title . PHP_EOL;
  echo 'https://news.yahoo.co.jp/hl?c=c_sci：'. $url . PHP_EOL;
	echo "<br><br>";
  getChiledPage($url);
 
  echo PHP_EOL.PHP_EOL;
}

/**
* もろもろ競合しちゃうと嫌なので関数化
* 小見出しを取得して出力
* @param string $url 子ページのURL
*/
function getChiledPage($url) {
  // ページを取得してオブジェクト化！
  $phpQueryObj = phpQuery::newDocument(file_get_contents($url));
 
  // ループでぶん回す
  foreach($phpQueryObj['href'] as $i => $val) {
    $komidashi = pq($val)->text();
    echo '小見出し['. $i .']：' . $komidashi . PHP_EOL;
  }
}
?>

</body>
</html>