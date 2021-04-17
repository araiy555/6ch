<ul>
  <?php
  $cid = 'arai';
  $uid = '72bfadfb39434837a2badb6692be8401';
  $access_token = '6846785650.72bfadf.a954f1eecbeb4f6b9dc098814e7ccfcc';
 
  //データを取得
  $result = json_decode(file_get_contents('https://api.instagram.com/v1/users/' . $uid . '/media/recent?client_id=' . $cid . '&access_token=' . $access_token), true);
  foreach($result&#91;'data'&#93; as $data) {
    //一番サイズの小さい画像を表示
    print '<li><img src="' . $data&#91;'images'&#93;&#91;'low_resolution'&#93;&#91;'url'&#93; . '" alt=""></li>';
  }
  ?>
</ul>