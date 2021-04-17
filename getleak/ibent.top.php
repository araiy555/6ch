

<?php

	error_reporting(0);


header('Expires: -1');
header('Cache-Control:');
header('Pragma:');
require('dbconnect.php');



$sql = "SELECT * FROM ibent  ;" ;
	$record = mysql_query($sql) or die(mysql_error());
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>EARTH</title>
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

<style media="screen">
.navbar .mega-dropdown {
position: static !important; }

.navbar .dropdown-menu.mega-menu {
width: 100%;
border: none;
border-radius: 0; }
.navbar .dropdown-menu.mega-menu a {
	padding: 0 0 0 0; }
	.navbar .dropdown-menu.mega-menu a.news-title {
		font-weight: 500;
		font-size: 1.1rem;
		line-height: 1.5;
		-webkit-transition: .2s;
		transition: .2s;
		color: #4f4f4f !important; }
		.navbar .dropdown-menu.mega-menu a.news-title:hover {
			color: #2196f3 !important; }
		.navbar .dropdown-menu.mega-menu a.news-title.smaller {
			font-weight: 400;
			font-size: 1rem;
			line-height: 1.4; }
.navbar .dropdown-menu.mega-menu .sub-menu a.menu-item {
	color: #4f4f4f !important; }
	.navbar .dropdown-menu.mega-menu .sub-menu a.menu-item:hover {
		color: #4f4f4f !important; }
.navbar .dropdown-menu.mega-menu .news-single {
	margin-bottom: 1.2rem;
	border-bottom: 1px solid #e0e0e0; }
.navbar .dropdown-menu.mega-menu .sub-title {
	padding-bottom: 0.5rem;
	margin-bottom: 1rem;
	border-bottom: 1px solid #e0e0e0; }
.navbar .dropdown-menu.mega-menu .p-sm {
	padding-bottom: 17px; }
.navbar .dropdown-menu.mega-menu .m-sm {
	margin-bottom: -5px;
	font-size: 0.85rem;
	color: #2196f3 !important; }
	.navbar .dropdown-menu.mega-menu .m-sm:hover {
		color: #2196f3 !important; }
.navbar .dropdown-menu.mega-menu .mt-sm {
	margin-top: -3px; }
.navbar .dropdown-menu.mega-menu .font-small {
	font-size: 0.85rem; }
</style>

</head>

<body>

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

		    <nav>
		    <div>
		    </div>
		    </nav>
		    <nav class="navbar navbar-expand-lg  navbar-light bg-white">

		        <!-- Collapse button -->
		        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
		            aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

		        <!-- Collapsible content -->
		        <div class="collapse navbar-collapse" id="navbarSupportedContent">

		            <!-- Links -->
		            <ul class="navbar-nav mr-auto">
		                <!-- Dropdown -->
		                <li class="nav-item dropdown mega-dropdown">
		                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">News </a>
		                    <div class="dropdown-menu mega-menu row z-depth-1" aria-labelledby="navbarDropdownMenuLink">
		                        <div class="row">
		                            <div class="col-md-5 col-xl-3 sub-menu mt-5 mb-5 pl-4">
		                                <ol class="list-unstyled mx-4 dark-grey-text">
		                                    <li class="sub-title text-uppercase mt-sm"><a class="menu-item" href="">Laptops</a></li>
		                                    <li class="sub-title text-uppercase"><a class="menu-item" href="">Phones</a></li>
		                                    <li class="sub-title text-uppercase"><a class="menu-item" href="">Lifestyle</a></li>
		                                    <li class="sub-title text-uppercase"><a class="menu-item" href="">Technology</a></li>
		                                    <li class="sub-title text-uppercase"><a class="menu-item" href="">Design</a></li>
		                                </ol>
		                            </div>
		                            <div class="col-md-7 col-xl-9">
		                                <div class="row">
		                                    <div class="col-xl-6 mt-5 mb-4 pr-5 clearfix d-none d-md-block">
		                                        <h6 class="sub-title p-sm mb-4 text-uppercase font-weight-bold dark-grey-text">Featured</h6>
		                                        <!--Featured image-->
		                                        <div class="view overlay pb-3">
		                                            <img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(42).jpg" class="img-fluid z-depth-1" alt="First sample image">
		                                            <div class="mask rgba-white-slight flex-center">
		                                                <p></p>
		                                            </div>
		                                        </div>
		                                        <h4 class="mb-2"><a class="news-title" href="">Lorem ipsum dolor sit amet, consectetur isum adipisicing elit.</a></h4>
		                                        <p class="font-small text-uppercase text-muted">By <a class="m-sm" href="#!">Anna Doe</a> - July 15, 2017</p>
		                                    </div>
		                                    <div class="col-xl-6 mt-5 mb-4 pr-5 clearfix d-none d-xl-block">
		                                        <h6 class="sub-title p-sm mb-4 text-uppercase font-weight-bold dark-grey-text">Recent</h6>
		                                        <div class="news-single">
		                                            <div class="row">
		                                                <div class="col-md-4">
		                                                    <!--Image-->
		                                                    <div class="view overlay z-depth-1">
		                                                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(43).jpg" class="img-fluid" alt="Minor sample post image">
		                                                        <div class="mask rgba-white-slight flex-center">
		                                                            <p></p>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-md-8">
		                                                    <a class="news-title smaller mb-1" href="">Duis aute irure dolor reprehenderit in voluptate.</a>
		                                                    <p class="font-small text-uppercase text-muted">July 14, 2017</p>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <div class="news-single">
		                                            <div class="row">
		                                                <div class="col-md-4">
		                                                    <!--Image-->
		                                                    <div class="view overlay z-depth-1">
		                                                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(44).jpg" class="img-fluid" alt="Minor sample post image">
		                                                        <div class="mask rgba-white-slight flex-center">
		                                                            <p></p>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-md-8">
		                                                    <a class="news-title smaller mb-1" href="">Tempore autem reiciendis iste nam dicta.</a>
		                                                    <p class="font-small text-uppercase text-muted">July 14, 2017</p>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <div class="news-single">
		                                            <div class="row">
		                                                <div class="col-md-4">
		                                                    <!--Image-->
		                                                    <div class="view overlay z-depth-1">
		                                                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(41).jpg" class="img-fluid" alt="Minor sample post image">
		                                                        <div class="mask rgba-white-slight flex-center">
		                                                            <p></p>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-md-8">
		                                                    <a class="news-title smaller mb-1" href="">Eligendi dicta sunt amet, totam ea recusandae.</a>
		                                                    <p class="font-small text-uppercase text-muted">July 14, 2017</p>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </li>
		            </ul>
		            <!-- Links -->

		            <!-- Links -->
		            <ul class="navbar-nav nav-flex-icons ml-auto">
		                <li class="nav-item">
		                    <a class="nav-link" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
		                </li>
		                <li class="nav-item">
		                    <a class="nav-link" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
		                </li>
		                <li class="nav-item">
		                    <a class="nav-link" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
		                </li>
		            </ul>
		            <!-- Links -->

		        </div>
		        <!-- Collapsible content -->

		    </nav>




  <div class="wrapper">

    <section class="contents__inner2">
			<?php
			$kml = mysql_num_rows($record);

			if($kml == 0){
			echo "該当データはありません";
			exit;
			}else{
			echo "出力結果";

			}
			?>


			<?php

			while($post = mysql_fetch_assoc($record)):
			?>
				<section class="contents__inner5">

				<?php echo $post['created']; ?><br>

			<a href="ibentnaiyou.php?id=<?php echo $post['id']; ?>">	<?php echo $post['taitol']; ?><br></a>


		<?php echo $post['url']; ?><br>

				</section>
			<?php
			endwhile;
			?>


		      </section>



    </section>

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
	<!-- Footer -->
	<footer class="page-footer font-small black">

	  <!-- Copyright -->
	  <div class="footer-copyright text-center py-3">© 2018 Copyright:
	    <a href="https://mdbootstrap.com/bootstrap-tutorial/"> MDBootstrap.com</a>
	  </div>
	  <!-- Copyright -->

	</footer>
	<!-- Footer -->
</html>
