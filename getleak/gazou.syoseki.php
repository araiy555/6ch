


<?php
require('dbconnect.php');
error_reporting(0);

  if($_REQUEST['search']){
    $value = $_REQUEST['search'];
    $id = '書籍';
     $sql = sprintf("SELECT * FROM  posts WHERE kategori = '%s' AND gazouid AND taitol ='$value' ORDER BY created DESC",
      mysql_real_escape_string($id)
    );
     $record = mysql_query($sql) or die(mysql_error());

  }else{
    $id = '書籍';
     $sql = sprintf("SELECT * FROM  posts WHERE kategori = '%s' AND gazouid ORDER BY created DESC",
      mysql_real_escape_string($id)
    );
     $record = mysql_query($sql) or die(mysql_error());
  }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
<meta name="description" content="EARTHは、同じ職業の人たちと交流を深めることのできるソーシャルユーティリティサイトです。EARTHを利用すれば、同じ職業の人と質問し合い最新の情報をチェックしたり、写真をアップロードしたり(枚数は無制限)、リンクや動画を投稿したり、新たな可能性を.">
<title>EARTH</title>
<link rel="shortcut icon" href="img/favicon1.ico" type="image/x-icon">

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
 body {
     font-family: Helvetica, Arial, ;
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
 	<!--
 	function Check(){
 	if(document.sati.search.value==""){
 	alert("コメントを入力してください。");
 	return	false;
 	}

 	return	true;
 	}
 	//	-->
 	</script>

   	<script language="JavaScript">
   	<!--
   	function Check2(){
   	if(document.satim.search.value==""){
   	alert("コメントを入力してください。");
   	return	false;
   	}

   	return	true;
   	}
   	//	-->
   	</script>

</head>

<body>
  <header class="header clearfix">
    <nav class="navbar  navbar-expand-lg justify-content-center navbar-light scrolling-nav bg-white">
      <!-- Navbar brand -->

      <a class="navbar-brand" href="taitol.php">
         <img alt="" src="img/EARTH4.png" width="100" height="30" class="img-fluid flex-center" ></a>
      <!-- Collapse button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
       aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Collapsible content -->
      <div class="collapse navbar-collapse" id="basicExampleNav">

        <div class=" d-block d-sm-none">
        <ul class="navbar-nav mr-auto">

          <li class="nav-item ">
            <a class="nav-link" href="touroku.php">新規登録</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="login.php">ログイン</a>
          </li>

        </ul>
</div>
<div class="col-md-4">
<script type="text/javascript">
function sample() {
var browser = document.fm.s.value;
location.href = browser;
}
</script>
<div class=" d-none d-sm-block">
        <form name="fm">
<select class="browser-default custom-select" name="s" onchange="sample()">
  <option value="">---フィルターを選択---</option>
  <option value="taitol.login.php?New">すべて</option>
  <option value="taitol.login.php?populer=1">人気</option>
  <option value="taitol.login.php?climax=1">盛り上がり</option>

</select>
</form>
</div>

      </div>

      <div class="col-md-8">
             <div class=" d-none d-sm-block">
               <form action="gazou.syoseki.php" method="GET" name="sati" onsubmit="return Check()">
                       <input type="text" class="form-control" id="keyword"name="search" value="" placeholder="Earthの検索またはチャンネル">
               </form>
            </div>
          </div>

        </div>


 <ul class="navbar-nav nav-flex-icons">
   <li class="nav-item">
     <a class="nav-link" href="taitol.login.php?populer=1" data-toggle="tooltip" title="人気"><i class="fa fa-line-chart" aria-hidden="true"></i></a>
   </li>
   <li class="nav-item">
     <a class="nav-link" href="taitol.login.php?climax=1" data-toggle="tooltip" title="盛り上がり"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>
   </li>
   <li class="nav-item">
     <a class="nav-link" href="taitol.login.php?New"data-toggle="tooltip" title="最新"><i class="fa fa-address-card" aria-hidden="true"></i></a>
   </li>
   <!--<li class="nav-item">
     <a class="nav-link" href="taitol.login.php?New"><i class="fa fa-commenting" aria-hidden="true"></i></a>
   </li>
   <li class="nav-item">
    <a class="nav-link" href="taitol.login.php?New"><i class="fa fa-envelope" aria-hidden="true"></i></a>
  </li>
   <li class="nav-item">

    <a class="nav-link" href="user/user.php" data-toggle="tooltip" title="投稿"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

  </li>-->
 </ul>


 <div class=" d-none d-sm-block" >
<ul class="navbar-nav mr-auto">

<li class="nav-item ">
<a class="nav-link" href="touroku.php">新規登録</a>
</li>
<li class="nav-item ">
<a class="nav-link" href="login.php">ログイン</a>
</li>

</ul>

</div>
<div class=" d-none d-sm-block" >

 <div class="col-xs-12">
              <select class="browser-default custom-select">
                <option value="1">日本</option>

              </select>
            </div>
</div>
</div>

    </nav>

    <!--Navbar-->
    <div class=" d-block d-sm-none">
    <nav class="navbar  navbar-expand-lg  navbar-light scrolling-nav bg-white">
      <div class="col-md-12 mb-12">
        <form action="" method="GET" name="satim" onsubmit="return Check2()">
                <input type="text" class="form-control" id="keyword"name="search" value="" placeholder="Earthの検索またはチャンネル">
        </form>
         </div>
    </nav>

      </div>

<header class="header clearfix">
  <nav class="navbar  navbar-expand-lg justify-content-center navbar-light scrolling-nav bg-white">
    <!-- Navbar brand -->
    

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

     <!-- Links -->
     <ul class="navbar-nav mr-auto">

       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">設定</a>
        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/EARTH/menu/demo/book/Configuration.book.php">検索設定</a>
          <a class="dropdown-item" href="/EARTH/menu/demo/language/language.php">言語（language）</a>
        </div>
      </li>

     </ul>

  </nav>






    			<div class="container">
            <!-- Grid row -->
          <div class="col-md-12">
            <?php
            $kml = mysql_num_rows($record);

            if($kml == 0){
              ?>
<br>
            <div class="card border-light mb-12" >
                <div class="card-header">書籍</div>
                <div class="card-body">
                <?php echo '情報がありませんでした。' ?>
                </div>
                </div>
<?php
            exit;
            }else{
            }
            ?>

    <section class="team-section text-center my-5">
      <!-- Grid row -->
      <div class="row">


    					<?php

    					while($post = mysql_fetch_assoc($record)):
    					?>


              <?php
              require('dbconnect.php');

              try {

              $id = $post['gazouid'];

                  $images = $pdo->query("select * from upload where id='$id'");

              } catch (PDOException $e) {
                  // 500 Internal Server Errorでテキストとしてエラーメッセージを表示
              http_response_code(500);
              header('Content-Type: text/plain; charset=UTF-8', true, 500);
                  exit($e->getMessage());
              }

              // HTMLとして表示 (文字コードもここで指定するために上書きする)

              ?>



            <!-- Grid column -->
            <div class="col-lg-3 col-md-6 mb-lg-0 mb-5">
              <div class="avatar mx-auto">
                <?php if (!empty($images)): ?>

         <?php foreach ($images as $i => $img): ?>
         <?php if ($i): ?>
              <hr />
         <?php endif; ?>


                <img src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>"width="50%"    alt="画像<?=$i+1?>">


         <?php endforeach; ?>

         <?php endif; ?>



              </div>
              <h5 class="font-weight-bold mt-4 mb-3">	</h5>
              <p class="text-uppercase blue-text"><strong><a href="searth.following.toukou.php?id=<?php echo $post['id']; ?>"><?php echo $post['taitol']; ?></strong></p>
              <p class="grey-text"><?php echo $post['kiji']; ?></p>

              <div class="orange-text">
                      <i class="fa fa-star"> </i>
                      <i class="fa fa-star"> </i>
                      <i class="fa fa-star"> </i>
                      <i class="fa fa-star"> </i>
                      <i class="fa fa-star"> </i>
              </div>
                    <a href="searth.following.toukou.php?id=<?php echo $post['id']; ?>" class="btn btn-primary btn-md">閲覧する</a>

            </div>
            <!-- Grid column -->


					<?php endwhile; ?>

        </div>
        <!-- Grid row -->

      </section>
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
