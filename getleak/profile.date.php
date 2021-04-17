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
      //検索ボタンがクリックされたら処理が走ります。
      $('#sending').click(function() {
        //バリデーション処理
        var member_id = $('#member_id').val();
        console.log(member_id);
          var browser = $('#browser').val();
          console.log(browser);
        var nationality = $('[name=nationality]').val();
        console.log(nationality);
        var family_name = $("#family_name").val();
        var name = $("#name").val();
        console.log(family_name);
        console.log(name);
        var sex = $('[name=sex]').val();
        console.log(sex);
        var age = $('[name=age]').val();
        console.log(age);
        var occupation = $('[name=occupation]').val();
        console.log(occupation);
        var phone_number = $("#phone_number").val();
        console.log(phone_number);
        var mail_address = $("#mail_address").val();
        console.log(mail_address);
        var self_introduction = $("#self_introduction").val();
        console.log(self_introduction);
        var error = {};
        var error_data = '';
        var pattern_halfwidth_number_comma = /[^0-9\,\s]+/;
        var pattern_halfwidth_digit = /[^0-9]/;
        var pattern_only_space = /^\s+/;
        // if (!product_id && !model_number && !product_name && !maker_list && !keyword && !group5) {
        //   error.all = 1;
        //   error_data += '入力をおこなってください。\n';
        // }
        // if (product_id.match(pattern_halfwidth_digit)) {
        //   error.product_id = 1;
        //   error_data += '商品IDは半角数字で入力してください。\n';
        // }
        // if (group5.match(pattern_only_space) || model_number.match(pattern_only_space) || product_name.match(pattern_only_space) || keyword.match(pattern_only_space)) {
        //   error.apace_check = 1;
        //   error_data += 'スペースを検索することはできません。\n';
        // }
        // if (group5.match(pattern_halfwidth_number_comma)) {
        //   error.group5 = 1;
        //   error_data += '小区分は半角数字と「,」「空白」の組み合わせで入力してください。\n';
        // }
        //
        // var result = Object.keys(error).length;
        // if (result == 0) {
          var data = {
             member_id : $("#member_id").val(),
              browser : $("#browser").val(),
            nationality : $('[name=nationality]').val(),
            family_name : $("#family_name").val(),
            name : $("#name").val(),
            sex : $('[name=sex]').val(),
            age : $('[name=age]').val(),
            occupation : $('[name=occupation]').val(),
            phone_number : $("#phone_number").val(),
            mail_address : $("#mail_address").val(),
            self_introduction : $("#self_introduction").val(),
          };
          //ここからajaxの処理です。
          $.ajaxSetup({
            scriptCharset: 'utf-8'
          });
          $.ajax({
            //POST通信
            type: "POST",
            //ここでデータの送信先URLを指定します。
            url: "date.touroku.php",
            data: data,
            //処理が成功したら
            success: function(data) {
                alert(data);
            },
            //処理がエラーであれば
            error: function() {
              alert('ブラウザをリロードして再度お試しください。解決しない場合は「開発」までご連絡ください。');
            }
          });
        // } else {
        //   alert(error_data);
        //   return false;
        // }
      });
    });
    function file_upload()
{
    // フォームデータを取得
    var formdata = new FormData($('#my_form').get(0))
    formdata.append("member_id", $('#member_id').val());
    console.log(formdata);
    // POSTでアップロード
    $.ajax({
        url  : "profile.check.php",
        type : "POST",
        data: formdata,
        cache       : false,
        contentType : false,
        processData : false,
        dataType    : "html"
    })
    .done(function(data, textStatus, jqXHR){
        alert(data);
    })
    .fail(function(jqXHR, textStatus, errorThrown){
        alert("fail");
    });
}

function background_upload()
{
// フォームデータを取得
var formdata = new FormData($('#my_background').get(0))
formdata.append("member_id", $('#member_id').val());
console.log(formdata);
// POSTでアップロード
$.ajax({
    url  : "background.check.php",
    type : "POST",
    data: formdata,
    cache       : false,
    contentType : false,
    processData : false,
    dataType    : "html"
})
.done(function(data, textStatus, jqXHR){
    alert(data);
})
.fail(function(jqXHR, textStatus, errorThrown){
    alert("fail");
});
}

        		</script>

</head>

		<?php
		try {
		$setid = $member['id'];
		$image_data = $pdo->query("select * from profile where member_id='$setid' ORDER BY modified DESC LIMIT 1");
		} catch (PDOException $e) {
		    // 500 Internal Server Errorでテキストとしてエラーメッセージを表示
		http_response_code(500);
		header('Content-Type: text/plain; charset=UTF-8', true, 500);
		    exit($e->getMessage());
		}
		$sql = "select member_id from profile where member_id='$setid' ORDER BY modified DESC LIMIT 1" ;
		$arai = mysql_query($sql) or die(mysql_error());
		$sql =  sprintf("SELECT  m.id, m.simei, m.name, p.following_id, p.user_id FROM following p, members m WHERE p.user_id ='%s'  GROUP BY  p.user_id, p.following_id HAVING COUNT(*)>1",
		mysql_real_escape_string($se)
		);
		$recordimage = mysql_query($sql) or die(mysql_error());
		?>
<body>

<?php
error_reporting(0);
require_once 'nav/nav3.php'; ?>
<div class="container">

<!-- Grid row -->
<div class="row">
<div class="col-md-8">

<br>
<div class="card">
  <h5 class="card-header h5">基本データ</h5>
  <div class="card-body">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
          aria-controls="pills-home" aria-selected="true">設定</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
          aria-controls="pills-profile" aria-selected="false">画像</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
          aria-controls="pills-contact" aria-selected="false">背景</a>
      </li>
    </ul>
    <hr>
    <input type="hidden" id="member_id" class="form-control" value="<?php echo $member['id'];?>">
    <div class="tab-content pt-2 pl-1" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">


          <div class="form-group">

              <select id="browser" class="browser-default custom-select">
                  <option value="1"<?php if($member['is_activate'] == 1){?> selected <?php } ?> >他者の投稿を許可</option>
                  <option value="0"<?php if($member['is_activate'] == 0){?> selected <?php } ?>>他者の投稿を無効</option>
              </select>

              <label for="exampleSelect1exampleFormControlSelect1"><span class="badge badge-pill badge-primary">国籍</span></label>
    <select class="form-control" name="nationality"id="nationality">
                <OPTION  value="<?php echo $member['kokuseki']; ?>">
                  <?php if($member['kokuseki']){
                  echo $member['kokuseki'];
                }else{
                  echo '国籍を入力してください';
                }
                ?>
              </OPTION>
              <?php   for ($i = 1; ; $i++) {
           if ($i > 64) {break;}?>
           <OPTION value="<?php echo $db_conf[$i]; ?>"><?php echo $db_conf[$i]; ?></OPTION>
           <?php }?>
            </select>
          </div>

      <div class="form-row">
        <div class="col">
            <span class="badge badge-pill badge-primary">チャンネル</span>
          <input type="text" id="family_name" class="form-control" value="<?php echo $member['simei'];?>" placeholder="<?php echo $member['simei'];?> ">
        </div>
      </div>

          <div class="form-group">
            <label for="exampleSelect1exampleFormControlSelect1"><span class="badge badge-pill badge-primary">性別</span></label>
            <select class="form-control"name="sex" id="sex">
                <OPTION value="<?php echo $member['seibetu']; ?>">
             <?php if($member['seibetu']){
                  echo $member['seibetu'];
                }else{
                  echo '性別を入力してください';
                }
                ?>
              </OPTION>
        <option value="男性">男性</option>
        <option value="女性">女性</option>
            </select>
          </div>
          <div class="form-group">
              <label for="exampleSelect1exampleFormControlSelect1"><span class="badge badge-pill badge-primary">年齢</span></label>
              <select class="form-control" name="age" id="age">
                <OPTION value="<?php echo $member['tosi']; ?>">
             <?php if($member['tosi']){
                  echo $member['tosi'];
                }else{
                  echo '年齢を入力してください';
                }
                ?>
              </OPTION>
        <?php for($i = 1; $i<=150; $i++):?>
        <option><?php echo $i;?></option>
        <?php endfor;?>
            </select>
          </div>
          <div class="form-group">
              <label for="exampleSelect1exampleFormControlSelect1"><span class="badge badge-pill badge-primary">職業</span></label>
              <select class="form-control" name="occupation" id="occupation">
                <OPTION value="<?php echo $member['job']; ?>">
                  <?php if($member['job']){
                  echo $member['job'];
                }else{
                  echo '職業を入力してください';
                }
                ?>

              </OPTION>
              <?php   for ($i = 100; ; $i++) {
           if ($i > 128) {break;}?>

           <OPTION value="<?php echo $db_conf[$i]; ?>"><?php echo $db_conf[$i]; ?></OPTION>
           <?php }?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1"><span class="badge badge-pill badge-primary">電話番号</span></label>
            <input type="email" class="form-control" id="phone_number"value="<?php echo $member['renrakubango'];?>" placeholder="<?php echo $member['renrakubango'];?>">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1"><span class="badge badge-pill badge-primary">Eメールアドレス</span></label>
            <input type="email" class="form-control" id="mail_address"value="<?php echo $member['renrakuadoresu'];?>" placeholder="<?php echo $member['renrakuadoresu'];?>">
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1"><span class="badge badge-pill badge-primary">自己紹介</span></label>
            <textarea class="form-control" id="self_introduction"value="<?php echo $member['message'];?>" rows="3"><?php echo $member['message'];?> </textarea>
          </div>
            <button id="sending" class="btn btn-primary">送信</button>
     </div>
      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          <br>

    <form id="my_form">
        <input type="file" name="file_1">
        <input type="hidden" id="member_id" class="form-control" value="<?php echo $member['id'];?>">
        <button type="button" onclick="file_upload()">アップロード</button>
        </form>
          <!-- <form action="profile.check.php" method="post" enctype="multipart/form-data"  accept="image/*">
          <input type="file" name="file" id="file"/>
          <input type="submit" value="OK"/>
          </form> -->
          <br>
          <span class="badge badge-pill badge-danger">画像の横幅は400pxでアップロードしてください。画像の縦は400pxでアップロードしてください</span>
          <br>
          <hr>
                          <?php

                          $kml = mysql_num_rows($arai);
                          if($kml == 0){
                                      echo "<img class='boxbox' src='img/noimage.png'  width='40%' style='border-radius: 200px;' alt='読み込み中…'>";
                          }
                          ?>

                          <?php if (!empty($image_data)): ?>

                          <?php foreach ($image_data as $i => $img): ?>
                          <?php if ($i): ?>

                          <?php endif; ?>

                      <div class="photo">

                                      <a href="profile.php">	<img class="boxbox" src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>" width="10%" style="border-radius: 200%;" alt="読み込み中…"></a>

                                  </div>
                                  <!-- Card image-->
                              <?php endforeach; ?>

                              <?php endif; ?>


      </div>
      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

            <!-- <form action="background.check.php" method="post" enctype="multipart/form-data"  accept="image/*">
            <input type="file" name="file" id="file"/>
            <input type="submit" value="OK"/>
            </form> -->
            <form id="my_background">
                <input type="file" name="file_1">
                <button type="button" onclick="background_upload()">アップロード</button>
            </form>
            <br>
            <span class="badge badge-pill badge-danger">画像の横幅は1500pxでアップロードしてください。画像の縦は500pxでアップロードしてください。</span>
            <br><hr>
            <?php
            $sql = "select member_id from background where member_id='$setid' ORDER BY modified DESC LIMIT 1" ;
              $error = mysql_query($sql) or die(mysql_error());
            ?>
            <?php
            try {
            $user_background = $pdo->query("select * from background where member_id='$setid' ORDER BY modified DESC LIMIT 1");
            } catch (PDOException $e) {
            		// 500 Internal Server Errorでテキストとしてエラーメッセージを表示
            http_response_code(500);
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            		exit($e->getMessage());
            }

            $kml = mysql_num_rows($error);
            if($kml == 0){
                  echo "<img class='background' src='img/black.jpg'  width='100%'  alt='読み込み中…'>";
            }
            ?>

            <?php if (!empty($user_background)): ?>

            <?php foreach ($user_background as $i => $img): ?>
            <?php if ($i): ?>

            <?php endif; ?>

            <a href="background.php">	<img class="background" src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>" width="100%" alt="読み込み中…"></a>

                  <!-- Card image-->
                <?php endforeach; ?>

                <?php endif; ?>

      </div>
    </div>
  </div>
</div>
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
