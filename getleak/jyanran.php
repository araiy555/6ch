--ここから--
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>じゃらん.net Webサービス検索</title>
</head>
<body>
<?php

// リクエストURLからホテルIDを取得

//XMLデータ取得用ベースURL
$req = "http://jws.jalan.net/APIAdvance/HotelSearch/V1/?key=sco16097196538&h_name=足利&limit=5";

//XMLファイルをパースし、オブジェクトを取得
$xml = @simplexml_load_file($req)
  or die("XMLパースエラー");

// 施設画像
$ret .= "<a href=\"".$xml->Hotel->HotelDetailURL."\">";
$ret .= "<img src=\"".$xml->Hotel->PictureURL."\" alt=\"".$xml->Hotel->HotelName
."\">";
$ret .= "</a>[じゃらん.net提供]";

// 住所
$ret .= "<br>住所：〒".$xml->Hotel->PostCode." ".$xml->Hotel->HotelAddress;

// チェックイン、チェックアウト
$ret .= "<br>チェックイン：".$xml->Hotel->CheckInTime." チェックアウト：".$xml->
Hotel->CheckOutTime;

// ホテル概要
$ret .= "<br><br>".$xml->Hotel->HotelCatchCopy." ".$xml->Hotel->HotelCaption;

echo $ret;
?>
<p align="right">
<a href="http://www.jalan.net/jw/jwp0000/jww0001.do">
<img src="http://www.jalan.net/jalan/doc/jws/images/jws_88_50_gray.gif"
 alt="じゃらん Web サービス" title="じゃらん Web サービス" border="0"></a> </p>
</body>
</html>
--ここまで--
※一部Blog掲載用に改行が入っている。注意されたし。