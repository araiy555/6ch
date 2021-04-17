<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Earth News</title>
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
 nav{
width:100%;
overflow: hidden;
   }
nav div{
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}
nav ul{
 display: inline-table;
 max-width: 100%;
}
nav ul li{
display: table-cell;
}
::-webkit-scrollbar{
display: none;
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

</head>
<body >


  <header class="header clearfix">

    		<nav class="navbar  navbar-expand-lg  navbar-light scrolling-nav bg-white">

      <a class="navbar-brand" href="taitol.php">
        <img alt="" src="img/EARTH4.png" width="100" height="30" class="d-inline-block align-top" >
      </a>


    			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    				<span class="navbar-toggler-icon"></span>
    			</button>

    			<div class="collapse navbar-collapse" id="navbarSupportedContent">
    				<ul class="navbar-nav mr-auto">

    					<li class="nav-item"><a href="news.php" class="nav-link">ニュース</a></li>
    					<li class="nav-item"><a class="nav-link" href="jinbutu.top.php">チャンネル</a></li>
    					<li class="nav-item"><a class="nav-link" href="taitol.php">写真</a></li>
    					<li class="nav-item"><a class="nav-link" href="douga.anime.php">動画</a></li>
    					<li class="nav-item"><a class="nav-link" href="situmon.php">質問</a></li>
    					<li class="nav-item"><a class="nav-link" href="gazou.syoseki.php">書籍</a></li>
    					<li class="nav-item"><a class="nav-link" href="syoping.php">ショップ</a></li>
    					<li class="nav-item"><a class="nav-link" href="ibent.top.php">イベント</a></li>
    					<li class="nav-item"><a class="nav-link" href="map1.php">マップ</a></li>
    					<li class="nav-item"><a class="nav-link" href="ranking.php">ランキング</a></li>
    					<li class="nav-item"><a class="nav-link" href="kyuujin.top.php">求人</a></li>
    				</ul>
    				<ul class="nav navbar-nav nav-flex-icons ml-auto">
    					<li class="nav-item">
    						<a href="main.message.php"class="nav-link"><i class="fa fa-envelope"></i> メール</a>
    					</li>
    					<li class="nav-item">
    						<a href="touroku.php"class="nav-link"><i class="fa fa-comments-o"></i> 新規登録</a>
    					</li>
    					<li class="nav-item">
    						<a href="login.php" class="nav-link"　><i class="fa fa-user"></i> ログイン</a>
    					</li>
    					<li class="nav-item dropdown">
    						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    							アプリ
    						</a>
    						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
    							<a class="dropdown-item" href="#">Action</a>
    							<a class="dropdown-item" href="#">Another action</a>
    							<a class="dropdown-item" href="#">Something else here</a>
    						</div>
    					</li>
    				</ul>
    			</div>
    		</nav>

  <nav class="navbar  navbar-expand-lg  navbar-light scrolling-nav bg-white">
  <div>
    <ul >
      <li class="nav-item danger-color-dark">
          <a class="nav-link white-text" href="#!">news</a>
      </li>
      <li class="nav-item warning-color-dark">
          <a class="nav-link white-text" href="#!">Link</a>
      </li>
      <li class="nav-item success-color-dark">
          <a class="nav-link white-text" href="#!">Link</a>
      </li>
      <li class="nav-item info-color-dark">
          <a class="nav-link white-text" href="#!">Link</a>
      </li>
      <li class="nav-item default-color-dark">
          <a class="nav-link white-text" href="#!">Link</a>
      </li>
      <li class="nav-item secondary-color-dark">
          <a class="nav-link white-text" href="#!">news</a>
      </li>
      <li class="nav-item danger-color-dark">
          <a class="nav-link  white-text " href="#!">Link</a>
      </li>
      <li class="nav-item warning-color-dark">
          <a class="nav-link white-text" href="#!">Link</a>
      </li>
      <li class="nav-item success-color-dark">
          <a class="nav-link white-text" href="#!">Link</a>
      </li>
      <li class="nav-item info-color-dark">
          <a class="nav-link white-text" href="#!">Link</a>
      </li>
      <li class="nav-item default-color-dark">
          <a class="nav-link white-text" href="#!">Link</a>
      </li>
      <li class="nav-item secondary-color-dark">
          <a class="nav-link white-text" href="#!">news</a>
      </li>

  </ul>
  </div>
  </nav>
</header>

  <div class="container">

  <div class="row">
  	<div class="col-md-12 col-sm-12 col-xs-12">




  			<?php
  error_reporting(0);
  $str = 'ニュース';
  			$querytag = "https://news.google.com/news/rss/headlines/section/q/$str/ニュース?ned=jp&hl=ja&gl=JP&";


  			$gxml = simplexml_load_file($querytag);

  			foreach ($gxml->channel->item as $item) {

  				if ($item) {


  			   	 echo "<div class='my-2'>
             <div class='card'>
             <div class='my-2'>
$item->description
</div></div>";


  			   	} else {
  			            echo "simplexml_load_fileでエラー";
  			        }

  			}

  			?>


      </div>
</div>

</div>

</div>





  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
</body>
<footer class="page-footer font-small unique-color">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
    <a href="https://mdbootstrap.com/bootstrap-tutorial/"> MDBootstrap.com</a>
  </div>
  <!-- Copyright -->

</footer>
</html>
