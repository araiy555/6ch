<!doctype html>
<html>
<head>
	<meta name="description" content="EARTHは、同じ職業の人たちと交流を深めることのできるソーシャルユーティリティサイトです。EARTHを利用すれば、同じ職業の人と質問し合い最新の情報をチェックしたり、写真をアップロードしたり(枚数は無制限)、リンクや動画を投稿したり、新たな可能性を.">
	<title>EARTH | ログイン</title>
	<link rel="shortcut icon" href="img/favicon3.ico" type="image/x-icon">

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
  <script type="text/javascript">
    new WOW().init()
  </script>
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
	.grey{
		background: url("img/codepen.svg")no-repeat center center;
		background-size: cover;
	}
	.navbar {
		background-color: transparent;

	}
  html,
  body,
  header,
  .view {
    height: 100%;
  }

  @media (max-width: 740px) {
    html,
    body,
    header,
    .view {
      height: 1000px;
    }
  }

  @media (min-width: 800px) and (max-width: 850px) {
    html,
    body,
    header,
    .view {
      height: 650px;
    }
  }
  @media (min-width: 800px) and (max-width: 850px) {
    .navbar:not(.top-nav-collapse) {
       background: #1C2331!important;
    }
  }
  /* Navbar animation */
  .navbar {
    background-color: rgba(0, 0, 0, 0.3); }

  .top-nav-collapse {
    background-color: #1C2331; }

  /* Adding color to the Navbar on mobile */
  @media only screen and (max-width: 768px) {
    .navbar {
      background-color: #1C2331; } }

  /* Footer color for sake of consistency with Navbar */
  .page-footer {
    background-color: #1C2331; }



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


	<?php
		require('dbconnect.php');
		error_reporting(0);
		session_start();

		if($_COOKIE['email'] !=''){
		$_POST['email'] = $_COOKIE['email'];
		$_POST['password'] = $_COOKIE['password'];
		$_POST['save'] = 'on';
		}

		if (!empty($_POST)) {
		//???O?C???????
			if($_POST['email'] !=='' && $_POST['password'] !==""){
			$sql = sprintf('SELECT * FROM members WHERE email="%s" AND password="%s"',
			mysql_real_escape_string($_POST['email']),
			sha1(mysql_real_escape_string($_POST['password']))
			);
			$record = mysql_query($sql) or die(mysql_error());
			if ($table = mysql_fetch_assoc($record)) {
			//ログイン成功
			$_SESSION['id'] = $table['id'];
			$_SESSION['time'] = time();
			if($_POST['save'] =='on'){
			setcookie('email',$_POST['email'],time()+60*60*24*14);
			setcookie('password',$_POST['password'],time()+60*60*24*14);
			}

			header('Location: kiji.input.php');
			} else {
				$error['login'] = 'failed';
			}
		} else {
			$error['login'] = 'blank';
		}
	}
	?>
<!-- サイドメニュー -->

  <!-- メインコンテンツ -->

		<body class="grey lighten-3" >

      <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
          <div class="container">

            <!-- Brand -->
            <a class="navbar-brand" href="https://mdbootstrap.com/docs/jquery/" target="_blank">
              <strong>EARTH</strong>
            </a>

            <!-- Collapse -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
              aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="taitol.php">Home
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="https://mdbootstrap.com/docs/jquery/" target="_blank">About MDB</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://mdbootstrap.com/docs/jquery/getting-started/download/" target="_blank">Free download</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://mdbootstrap.com/education/bootstrap/" target="_blank">Free tutorials</a>
                </li> -->
              </ul>

              <ul class="navbar-nav nav-flex-icons">
                <!-- <li class="nav-item">
                  <a href="https://www.facebook.com/mdbootstrap" class="nav-link" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="https://twitter.com/MDBootstrap" class="nav-link" target="_blank">
                    <i class="fab fa-twitter"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="https://github.com/mdbootstrap/bootstrap-material-design" class="nav-link border border-light rounded"
                    target="_blank">
                    <i class="fab fa-github mr-2"></i>MDB GitHub
                  </a>
                </li> -->
              </ul>

            </div>

          </div>
        </nav>
        <!-- Navbar -->

        <!-- Full Page Intro -->
        <div class="view full-page-intro" style="background-image: url('https://mdbootstrap.com/img/Photos/Others/images/78.jpg'); background-repeat: no-repeat; background-size: cover;">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="container">

              <!--Grid row-->
              <div class="row wow fadeIn">

                <!--Grid column-->
                <div class="col-md-6 mb-4 white-text text-center text-md-left ">

                  <h1 class="display-4 font-weight-bold">Welcome To Earth</h1>

                  <hr class="hr-light">
<!--
                  <p>
                    <strong>Best & free guide of responsive web design</strong>
                  </p> -->

                  <p class="mb-4 d-none d-md-block">
                    <strong>EARTHへようこそ。ログインして通知をチェックしたり、会話に参加したりフォローしているユーザの最近の情報をチェックしましょう。</strong>
                  </p>
                  <div class=" d-none d-sm-block">

    <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yi/r/OBaVg52wtTZ.png" alt="">

    </div>
                  <!-- <a target="_blank" href="https://mdbootstrap.com/education/bootstrap/" class="btn btn-indigo btn-lg">Start free tutorial
                    <i class="fas fa-graduation-cap ml-2"></i>
                  </a> -->

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6 col-xl-5 mb-4">

                  <!--Card-->
                  <div class="card">

                    <!--Card content-->
                    <div class="card-body">

                      <!-- Form -->
                      <?php if($error['login'] == 'blank'): ?>
                      <p class="error">*メールアドレスとパスワードをご記入ください</p>
                      <?php endif; ?>
                      <?php if($error['login'] == 'failed'): ?>
                      <p class="error">メールアドレスかパスワードが間違えています。</p>
                      <?php endif; ?>

                      <form action="" method="post">
                        <!-- Heading -->
                        <h3 class="dark-grey-text text-center">
                          <strong>ログイン</strong>
                        </h3>
                        <hr>

                        <dl>
                      		<dt>メールアドレス</dt>
                      		<dd>
                      			<input class="form-control" type="text"　 name="email"  placeholder="" value="<?php echo htmlspecialchars($_POST['email']); ?>"/>


                      		</dd>
                      		<br>
                      		<dt>パスワード</dt>
                      		<dd>


                      		<input type="password" name="password" id="form1"class="form-control" size="35" maxlength="255"
                      		value="<?php echo htmlspecialchars($_POST['password']); ?>" />




                      		</dd>
                      	</dl>

                        <div class="text-center">
                          <button type="submit" class="btn btn-indigo">ログイン</button>

                          <hr>
                          <fieldset class="form-check">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" name="save" value="on" id="defaultChecked2" checked>
                              <label class="custom-control-label" for="defaultChecked2">次回からは自動的にログインする<</label>
                            </div>
                          </fieldset>

                        </div>

                      </form>
                      <!-- Form -->

                    </div>

                  </div>
                  <!--/.Card-->

                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->

            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
        <!-- Full Page Intro -->

        <!--Main layout-->
        <main>


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
