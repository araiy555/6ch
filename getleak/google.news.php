
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
<div class="box11">
<?php 
 
if (isset($_POST["search"])) {
    $str = $_POST["search"];
} else {
    $str = $_REQUEST['id'];
}
 
$querytag = "https://news.google.com/news/rss/headlines/section/q/$str/ニュース?ned=jp&hl=ja&gl=JP&
"
   ;
 
$gxml = simplexml_load_file($querytag);

foreach ($gxml->channel->item as $item) {
 
	if ($item) {
   	 echo $item->description;
   	} else {
            echo "simplexml_load_fileでエラー";
        }
    
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