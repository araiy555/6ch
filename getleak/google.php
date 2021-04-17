<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="EARTHは、同じ職業の人たちと交流を深めることのできるソーシャルユーティリティサイトです。EARTHを利用すれば、同じ職業の人と質問し合い最新の情報をチェックしたり、写真をアップロードしたり(枚数は無制限)、リンクや動画を投稿したり、新たな可能性を.">
	<title>EARTH</title>
	<link rel="stylesheet" type="text/css" href="google.css">


  </head>
<body>
<?php
session_start();
header('Expires: -1');
header('Cache-Control:');
header('Pragma:');

$name = $_REQUEST['id'];
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

error_reporting(0);
//------------------------------------
// 定数設定
//------------------------------------
//APIキー
$apiKey = "AIzaSyD_Xi78rcvyRRsHDkUnRu_wsLR50ymuKKw";

//検索エンジンID
$searchEngineId = "010888326312722366461:crrizdeg1cm";

//検索用URL
$baseUrl = "https://www.googleapis.com/customsearch/v1?";

//取得開始位置
$startNum = 1;

//取得回数（APIを最大何回呼び出すか）
define("PAGE_GET_CNT", 1);

try {
    //--------------------------
    // 検索キーワード取得
    //--------------------------
    //$query = $_POST['q'];
    //$query = $_GET['q'];
    $query = $_REQUEST['id'];

    for($i = 1; $i <= PAGE_GET_CNT; $i++){

        //------------------------------------
        // リクエストパラメータ生成
        //------------------------------------
        $paramAry = array(
                        'q' => $query, 
                        'key' => $apiKey, 
                        'cx' => $searchEngineId, 
                        'alt' => 'json', 
                        'start' => $startNum
                );
        $param = http_build_query($paramAry);

        //------------------------------------
        // 実行＆結果取得
        //------------------------------------
        $reqUrl = $baseUrl . $param;
        $retJson = @file_get_contents($reqUrl, true);
        if($retJson === false){
            throw new Exception("取得失敗！：" . $http_response_header[0]);
        }

        $ret = json_decode($retJson, true);

        //------------------------------------
        // 結果表示
        //------------------------------------








        //画面表示
        //var_dump($ret);

        //JSON形式でファイル出力
        file_put_contents(dirname(__FILE__) . "/data/ret_" . $startNum . "_" . date('Ymd_His') . ".txt", $retJson);





        //項目を画面表示
        $num = $startNum;
        foreach($ret['items'] as $value){
           $len= $value['link'];
		 $lek= $value['title'];
		 $lio= $value['author'];
		$lio= $value['snippet'];
		echo '<a href="'.$len.'">'.$lek.'</a><br>';
		

       echo"" . $value['link']. "<br>\n";
	echo"" . $value['snippet']. "<br>\n";
	
	
	
 $num++;
        }

        //------------------------------------
        // 次ページの取得条件を設定
        //------------------------------------
        if(isset($ret['queries']['nextPage'][0]['startIndex'])){
            //次ページがあれば、取得開始位置を設定
            $startNum = $ret['queries']['nextPage'][0]['startIndex'];
        }else{
            //次ページがなければ、ループを抜ける
            break;
        }
    }
} catch (Exception $e) {
    print "エラー：" . $e->getMessage();
}

?>
</section>
 <section class="contents__inner2">
      
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 広告　箱 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-3518678681279293"
     data-ad-slot="4522055769"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
      </section>

    </main>


      <footer class="footer">
      <p>フッター</p>
    </footer>

    </body>
</html>
