


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Earth News</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
  <link href='../src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="news.css" rel="stylesheet">


  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />








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

<body>





  <header class="header clearfix">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>
    </button>
    <section class="earth1">

    <a href="taitol.php"><img src="img/EARTH4.png" width="170" height="25" alt="EARTH"></a>
    </section>

        <section class="earth2">
          <form action="searth.following.php" method="GET" name="sati" onsubmit="return Check()">
                  <input type="text" class="form-control" id="keyword"name="search"  value="" placeholder="Earthの検索またはチャンネル">
          </form>


    </section>
    <section class="earth3">
    <a href="login.php" ><img src="img/user.png" alt="<?php echo $member['simei']; ?><?php echo $member['name']; ?>"  title="<?php echo $member['simei']; ?><?php echo $member['name']; ?>" style="border-radius: 100px;"  align="middle"width="4%" height="5%" vspace="10"hspace="5"></a>


    </section>
  </header>



  <nav class="vertical_nav">
    <ul id="js-menu" class="menu">


			<li class="menu--item">
				<a href="taitol.php" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">ホーム</span>
				</a>
			</li>

			<li class="menu--item">
				<a href="news.php" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">トップニュース</span>
				</a>
			</li>

			<li class="menu--item">
				<a href="bijinesu.php" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">ビジネス</span>
				</a>
			</li>
			<li class="menu--item">
				<a href="entame.php" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">エンタメ</span>
				</a>
			</li>
      <li class="menu--item">
        <a href="game.php" class="menu--link" title="Item 5">
          <i class="menu--icon  fa fa-fw fa-globe"></i>
          <span class="menu--label">ゲーム</span>
        </a>
      </li>



			<li class="menu--item">
				<a href="sport.php" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">スポーツ</span>
				</a>
			</li>
			<li class="menu--item">
				<a href="technology.php" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">テクノロジー</span>
				</a>
			</li>
    </ul>

    <button id="collapse_menu" class="collapse_menu">
      <i class="collapse_menu--icon  fa fa-fw"></i>
      <span class="collapse_menu--label">Recolher menu</span>
    </button>

  </nav>


  <div class="wrapper">

    <main class="contents">


      <section class="contents__inner1">

        			<div class="box11">
			<?php
error_reporting(0);

if (isset($name)) {
    $str = $name;
} else {
    $str = $_REQUEST['id'];
}



			$querytag = "https://news.google.com/news/rss/headlines/section/q/$str/ニュース?ned=jp&hl=ja&gl=JP&";


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
</main>
    </section>


  </div>

  <script src="../dist/vertical-responsive-menu.min.js"></script>

</body>
</html>
