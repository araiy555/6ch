<?php
//フィード登録
$data['feedurl'][] = 'http://news.yahoo.co.jp/pickup/rss.xml'; //Yahoo!ニューストピックストップ
$data['feedurl'][] = 'http://rss.rssad.jp/rss/itmnews/2.0/news_bursts.xml'; //ITmedia ニュース速報
$data['feedurl'][] = 'http://japan.cnet.com/rss/index.rdf'; //CNET Japan
$data['feedurl'][] = 'http://feeds.reuters.com/reuters/JPTopNews'; //ロイター RSS

// RSS追加用（いくつでも追加可能,Atom,RSS1.0,RSS2.0に対応）
// $data['feedurl'][] = '';

$rssList = $data['feedurl'];

//同時呼び出し
$rssdataRaw = multiRequest($rssList);

for($n=0; $n < count($rssdataRaw); $n++){
  $rssdata = simplexml_load_string($rssdataRaw[$n]); //URL設定
  
  // Atom取得
  if($rssdata->entry){
    $site = $rssdata->title; // サイト名
    foreach($rssdata->entry as $myEntry){
      $myTitle = $myEntry->title;
      
      // 日時取得
      if (isset($myEntry->issued)) {
				$rssDate = $myEntry->issued;
			} else {
				$rssDate = $myEntry->published;
			}
      date_default_timezone_set('Asia/Tokyo');
      $myDateGNU = strtotime($rssDate);
      $myDate = date('Y/m/d - G:i',$myDateGNU);
      
      //リンクURL取得
      $myLink = $myEntry->link['href'];
      
      //サムネイル画像取得
      $myContent = $myEntry->content;
      $imgurl = "";
      $pattern = '/(ttps?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)\.(jpg|gif|png)/';
      if (preg_match_all($pattern, $myContent, $matches)) {
          foreach($matches[0] as $key=>$value) {
              $imgurl = "h{$value}";
          }
      } else {
          $imgurl = "img/no-image.jpg"; // 画像が見つからなければno-image画像を挿入
      }
      
      //連想配列($array)
      $array = array(
        "site" => $site,
      	"title" => $myTitle,
      	"url" => $myLink,
      	"date" => $myDate,
      	"image" => $imgurl,
      	"visit" => 'none',
      );
      $outdata[$myDateGNU] = $array;
    }
  }
  // rss1.0取得
  elseif($rssdata->item){
    $site = $rssdata->channel->title; //サイト名
    foreach($rssdata->item as $myEntry){
      $myTitle = $myEntry->title;
      
      // 日時取得
      $rssDate = $myEntry->pubDate;
      if(!$rssDate) $rssDate = $myEntry->children("http://purl.org/dc/elements/1.1/")->date;
      date_default_timezone_set('Asia/Tokyo');
      $myDateGNU = strtotime($rssDate);
      $myDate = date('Y/m/d - G:i',$myDateGNU);
      
      //リンクURL取得
      $myLink = $myEntry->link;
      
      //サムネイル画像取得
      $myContent = $myEntry->children("http://purl.org/rss/1.0/modules/content/")->encoded;
      $imgurl = "";
      $pattern = '/(ttps?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)\.(jpg|gif|png)/';
      if (preg_match_all($pattern, $myContent, $matches)) {
          foreach($matches[0] as $key=>$value) {
              $imgurl = "h{$value}";
          }
      } else {
          $imgurl = "img/no-image.jpg"; // 画像が見つからなければno-image画像を挿入
      }

      //連想配列($array)
      $array = array(
      	"site" => $site,
      	"title" => $myTitle,
      	"url" => $myLink,
      	"date" => $myDate,
      	"image" => $imgurl,
      	"visit" => 'none',
      );
      $outdata[$myDateGNU] = $array;
    }
  }
  // RSS2.0取得
  elseif($rssdata->channel->item){
    $site = $rssdata->channel->title; //サイト名
    $rssdata = $rssdata->channel;
    foreach($rssdata->item as $myEntry){
      $myTitle = $myEntry->title;
      
      // 日時取得
      $rssDate = $myEntry->pubDate;
      if(!$rssDate) $rssDate = $myEntry->children("http://purl.org/dc/elements/1.1/")->date;
      date_default_timezone_set('Asia/Tokyo');
      $myDateGNU = strtotime($rssDate);
      $myDate = date('Y/m/d - G:i',$myDateGNU);
      
      //リンクURL取得
      $myLink = $myEntry->link;
      
      //サムネイル画像取得
      $myContent = $myEntry->description;
      $imgurl = "";
      $pattern = '/(ttps?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)\.(jpg|gif|png)/';
      if (preg_match_all($pattern, $myContent, $matches)) {
          foreach($matches[0] as $key=>$value) {
              $imgurl = "h{$value}";
          }
      } else {
          $imgurl = "img/no-image.jpg"; // 画像が見つからなければno-image画像を挿入
      }
      
      //連想配列($array)
      $array = array(
        "site" => $site,
      	"title" => $myTitle,
      	"url" => $myLink,
      	"date" => $myDate,
      	"image" => $imgurl,
      	"visit" => 'none',
      );
      $outdata[$myDateGNU] = $array;
      
    }
  }

}

//同時取得したRSSを更新日時順にソート
krsort($outdata);

//データをJSON形式に変換
$nn = 0;
$output = '';

$length = count($outdata);

foreach($outdata as $outdata) {
  $nn++;
  
  $output.= json_encode($outdata);
  
  if($nn !== $length) {
    $output.= ',';
  } else {
    break;
  }
}

// データをJSONに格納
$html = '['.$output.']';
$json = fopen('feeddata.json', 'w+b');
flock($json, LOCK_SH);
fwrite($json, $html);
fclose($json);


//同時呼び出し関数
function multiRequest($data, $options = array()) {
 
  // array of curl handles
  $curly = array();
  // data to be returned
  $result = array();
  // multi handle
  $mh = curl_multi_init();
  // loop through $data and create curl handles
  // then add them to the multi-handle
  foreach ($data as $id => $d) {
    $curly[$id] = curl_init();
    $url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
    curl_setopt($curly[$id], CURLOPT_URL,            $url);
    curl_setopt($curly[$id], CURLOPT_HEADER,         0);
    curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);
    // post?
    if (is_array($d)) {
      if (!empty($d['post'])) {
        curl_setopt($curly[$id], CURLOPT_POST,       1);
        curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
      }
    }
    // extra options?
    if (!empty($options)) {
      curl_setopt_array($curly[$id], $options);
    }
    curl_multi_add_handle($mh, $curly[$id]);
  }
 
  // execute the handles
  $running = null;
  do {
    curl_multi_exec($mh, $running);
  } while($running > 0);
  // get content and remove handles
  foreach($curly as $id => $c) {
    $result[$id] = curl_multi_getcontent($c);
    curl_multi_remove_handle($mh, $c);
  }
  // all done
  curl_multi_close($mh);
  return $result;
}
?>