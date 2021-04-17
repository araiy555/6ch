<?php
session_start();
error_reporting(0);
require('dbconnect.php');
include_once 'Configuration/top.php';
$db_conf = include_once 'config.php';
// ログイン状態チェック
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
$_SESSION['time'] = time();
$sql=sprintf('SELECT * FROM members WHERE id=%d',
mysql_real_escape_string($_SESSION['id']));
$record = mysql_query($sql) or die(mysql_query());
$member = mysql_fetch_assoc($record);
}else{
header('Location: login.php');
}
?>
<?php

if(!empty($_GET)){
//エラー項目の確認
if($_GET['search'] == ''){
$error['search'] = 'blank';
}
if(empty($error)){
$_SESSION['join'] = $_GET;
header('Location: searth.following.php');
}
}
?><!--Main Navigation-->
<?php
try {
$id = $member['id'];
$images = $pdo->query("select * from profile where member_id='$id' ORDER BY modified DESC LIMIT 1");
} catch (PDOException $e) {
// 500 Internal Server Errorでテキストとしてエラーメッセージを表示
http_response_code(500);
header('Content-Type: text/plain; charset=UTF-8', true, 500);
exit($e->getMessage());
}
// HTMLとして表示 (文字コードもここで指定するために上書きする)
header('Content-Type: text/html; charset=UTF-8');
?>
<?php
$id = $member['id'];


$sql = "select member_id from profile where member_id='$id' ORDER BY modified DESC LIMIT 1" ;
$arai = mysql_query($sql) or die(mysql_error());

$jibun = $member['id'];

$sql =  sprintf("SELECT  m.id, m.simei, m.name, p.following_id, p.user_id FROM following p, members m WHERE p.user_id ='%s'  GROUP BY  p.user_id, p.following_id HAVING COUNT(*)>1",
mysql_real_escape_string($jibun)
);
$record = mysql_query($sql) or die(mysql_error());
?>
<?php
require('dbconnect.php');
/**
* ページング機能サンプル
*/
// エラーを表示してデバッグできるようにする
//ini_set('display_errors');
error_reporting(E_ALL);

/**
* エスケープ
* @param string $str
* @return string
*/
function h($str)
{
return htmlspecialchars($str, ENT_QUOTES, 'utf-8');
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<meta name="description" content="">
<title>GetLeak | <?php echo $member['simei'] ?><?php echo $member['name'] ?></title>
<link rel="shortcut icon" href="<?php echo $db_conf['1065']?>" type="image/x-icon">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="css/mdb.min.css" rel="stylesheet">
<!-- Your custom styles (optional) -->
<link href="css/style.min.css" rel="stylesheet">
<link href="css/channel.css" rel="stylesheet">
<link href="flickity.css" rel="stylesheet">
<link href="flickity-demo.css" rel="stylesheet">

<div id="loader-bg">
<img src="img/ajax-loader (4).gif">

</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
jQuery(window).on("load", function() {
jQuery('#loader-bg').hide();
});

</script>

        	<script language="JavaScript">
          $(function() {
      // 使用する要素名
      var IScontentItems = '.list__item'; // 取得する要素
      var IScontent = '.list'; // 取得要素を追加するコンテンツ
      var ISlink = '.pager__next'; // 次のページのリンク
      var ISlinkarea = '.pager'; // 次のページのリンクの親要素
      var loadingFlag = false; // 読み込み中はtrueにして、複数回発生しないようにする

      $(window).on('load scroll', function() {
          // 次のページ読み込み中の場合は処理を行わない
          if(!loadingFlag) {
              var winHeight = $(window).height();
              var scrollPos = $(window).scrollTop();
              var linkPos = $(ISlink).offset().top;

              if(winHeight + scrollPos > linkPos) {
                  loadingFlag = true;

                  // 次のページのリンクを取得して、要素を削除しておく
                  var nextPage = $(ISlink).attr('href');
                  $(ISlink).remove();
                  // 次のページの要素を取得
                  $.ajax({
                      type: 'GET',
                      url: nextPage,
                      dataType: 'html'
                  }).done(function(data) {
                      // 次のページのリンクを取得
                      var nextLink = $(data).find(ISlink);
                      // コンテンツ要素を取得
                      var contentItems = $(data).find(IScontentItems);

                      // コンテンツ要素を追加
                      $(IScontent).append(contentItems);

                      // 次のページがある場合はリンクを追加する
                      if(nextLink.length > 0) {
                          $(ISlinkarea).append(nextLink);
                          loadingFlag = false; // 次のページがない場合はloadingFlagをtrueにしたままにして、処理を発生しないようにする
                      }
                  }).fail(function () {
                      alert('ページの取得に失敗しました。');
                  });
              }
          }
      });
  });


        		</script>

</head>

<body>

<?php
error_reporting(0);
require_once 'nav/nav3.php'; ?>
<div class="container">
<!-- Grid row -->
<div class="row">
<div class="col-md-8">
    <br>
  <?php
  $memberid = $member['id'];
  $sql = posts($memberid);
  $record = mysql_query($sql) or die(mysql_error());?>

  <?php $kml = mysql_num_rows($record);?>
  <?php if ($kml == 0) { ?>
      <div class="container my-1 z-depth-1">


          <!--Section: Content-->
          <section class="dark-grey-text">

              <div class="row pr-lg-5">
                  <div class="col-md-7 mb-4">

                      <div class="view">
                          <img src="https://mdbootstrap.com/img/illustrations/graphics(4).png" class="img-fluid" alt="smaple image">
                      </div>

                  </div>
                  <div class="col-md-5 d-flex align-items-center">
                      <div>

                          <h6 class="font-weight-bold mb-4">お探しの記事は見つかりませんでした</h6>

                          <p>GetLeakは全世界すべての方が無料でアップロードすることが可能です。あなたの情報を公開してみよう!!</p>

                          <a href="channel?p=update" >   <button type="button" class="btn btn-orange btn-rounded mx-0">記事を作成する</button></a>

                      </div>
                  </div>
              </div>

          </section>
          <!--Section: Content-->


      </div>
  <?php }else{ ?>
  <?php while($post = mysql_fetch_assoc($record)):?>

    <?php $posts[] = array('id' => $post['id'],
    'member_id' => $post['member_id'],
    'kategori' => $post['kategori'],
    'kiji' => $post['kiji'],
    'gazouid' => $post['gazouid'],
    'dougaid' => $post['dougaid'],
    'taitol' => $post['taitol'],
    'editor' => $post['editor'],
    'created' => $post['created']
  );?>

  <?php endwhile;?>

  <?php
  define('MAX','10');

  $books_num = count($posts);
  $max_page = ceil($books_num / MAX);

  if(!isset($_GET['posts_id'])){
      $now = 1;
  }else{
      $now = $_GET['posts_id'];
  }

  $start_no = ($now - 1) * MAX;

  $disp_data1 = array_slice($posts, $start_no, MAX, true);



  ?>
  <div class="contents">
      <?php include('article.php');?>
   <?php
   if($now < $max_page){ // リンクをつけるかの判定
       echo '<div class="pager"><a class="pager__next" href=\'/main.php?posts_id='.($now + 1).'\')>次へ</a> </div>'. '　';
   } else {

   }?>

   </div>

  <?php }?>

</div>
<div class="col-md-4 ">
    <?php require_once('usercord.php');?>
    <?php require_once('right-menu.php');?>
</div>

</div>



</div>


<!-- Footer -->
<script src="flickity.pkgd.js"></script>
<script src="fire-flickity.js"></script>

<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>
