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
require('dbconnect.php');

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
<link href="flickity.css" rel="stylesheet">
<link href="flickity-demo.css" rel="stylesheet">


<style>
#loader-bg {
background: #fff;
height: 100%;
width: 100%;
position: fixed;
top: 0px;
left: 0px;
z-index: 10;
}
#loader-bg img {
background: #fff;
position: fixed;
top: 50%;
left: 50%;
-webkit-transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
transform: translate(-50%, -50%);
z-index: 10;
}
.p-global-nav .c-navbar__item > a > span {
flex-direction: column;
}
body{
font-family: Helvetica, Arial, ;
font-size: 12px;
background-color: #fff;

}
.wrapper {
position:relative;
display:inline-block;
font-size: 15px;
}

.label {
position:absolute;
color:white;
padding:5px 15px;
}
.label-left-top{
left:0px;
top:0px;

}
.label-right-top{
right:0px;
top:0px;
}
.label-left-bottom{
left:0px;
bottom:0px;
}
.label-right-bottom{
right:0px;
bottom:0px;
}
.navigation {
	display: flex;
	justify-content: space-between;
	align-items: center;
	width: 100%;
	list-style: none;
	overflow-x: auto;
	background: #fff;
	border-bottom: 1px solid #ccc;
}
.navigation-item {
	padding: 10px 10px;
	color: #333;
	word-break: keep-all;
	text-decoration: none;
}
.navigation-item:hover {
	color: #666;
}
.clearfix:after {
content: "";
clear: both;
display: block;
bottom: 0;
}
.boxbox{
float: left;
bottom: 0;

}
.boxbox p{
position: absolute;
bottom: 0;
font-size: 20px;

}
#box3 a {
position: absolute;
bottom: 0;
}
@media(max-width: 20px) {
.boxbox{
float: none;
bottom: 0;
}
}
</style>
<style media="screen">

.navbar {
box-shadow: 0 2px 5px 0 rgba(0,0,0,.0), 0 2px 10px 0 rgba(0,0,0,.100);
font-weight: 300;
}
/*css*/
/* 回り込みを終了する定型表現。 */
/*clearfix*/
.clearfix {
zoom: 1;
}
.clearfix:after {
content: "";
display: block;
clear: both;
}
.inner img{
width: 100px;
height: 100px;

border-radius:13%;
}

/*画像と文書を並べて表示時する*/
.inner {
float: left ;　 /*左側に配置する*/
}
.inner p{
float:right; 　 /*右側に配置する*/
}
/*検索ボックス*/
#keyword{

background:#eee;/*検索ボックスの背景カラー*/
}
/* スマホ横画面用 */
@media screen and (max-width: 480px) {
  .container-fluid{padding:0}
  div[class^="col-"] {padding:0}
  .row {margin:0;}
}
/* スマホ縦画面用 */
@media screen and (max-width: 320px) {
  .container-fluid{padding:0}
  div[class^="col-"] {padding:0}
  .row {margin:0;}
}
.sticky {
  position: -webkit-sticky;
  position: sticky;
  top: 10px;
}
.tab{
  display: table;
  margin-top: 20px;
}

.tab__button{
  display: table-cell;
  text-align: center;
  background-color: #000;
  vertical-align: middle;
  border: 2px solid white;
  border-bottom-width: 4px;
  min-width: 80px;
}

.tab__button.active{
  border-bottom: none;
}

.tab__button a{
  padding: 10px;
  color: #fff;
  display: block;
  text-decoration: none;
  font-size: 12px;
}

</style>

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
$commentid = $member['id'];
$sql = comment($commentid);
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

  <?php $comment[] = array('id' => $post['id'],'user_id' => $post['user_id'],'comment_id' => $post['comment_id'],'comment' => $post['comment'],'created' => $post['created']);?>

<?php endwhile;?>

<?php
define('MAX','10');

$books_num = count($comment);
$max_page = ceil($books_num / MAX);

if(!isset($_GET['comment_id'])){
    $now = 1;
}else{
    $now = $_GET['comment_id'];
}

$start_no = ($now - 1) * MAX;

$disp_data1 = array_slice($comment, $start_no, MAX, true);



?>
<div class="contents">
<div class="list" style="list-style:none">
    <div class="list__item">
      <?php
foreach($disp_data1 as $val){?>


<div class="list-group">
<a href="view.php?id=<?php echo $val['comment_id']; ?>" class="list-group-item list-group-item-action flex-column align-items-start">
<div class="clearfix">

<div class="inner clearfix">
</div>
<p> <?php $str = h($val['comment']);
$str = mb_strimwidth($str, 0, 105, '…', 'UTF-8');
echo $str;?></p>
<hr>
<br>
<?php echo $val['created'];?>
</div>
</a>
</div>

 <?php }?>

</div>
</div>
 <?php
 if($now < $max_page){ // リンクをつけるかの判定
     echo '<div class="pager"><a class="pager__next" href=\'/profile.comment.php?comment_id='.($now + 1).'\')>次へ</a> </div>'. '　';
 } else {

 }?>

 </div>

<?php }?>







</div>

<!-- Grid column -->
<div class="col-md-4">
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
