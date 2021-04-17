


	<?php
		require('dbconnect.php');
		error_reporting(0);
		session_start();
    $db_conf = include_once 'config.php';
		if($_COOKIE['email'] !=''){
		$_POST['email'] = $_COOKIE['email'];
		$_POST['password'] = $_COOKIE['password'];
		$_POST['save'] = 'on';
		}
		if (!empty($_POST)) {
			if($_POST['email'] !=='' && $_POST['password'] !==""){
			$sql = sprintf('SELECT * FROM members WHERE email="%s"',
			mysql_real_escape_string($_POST['email'])
			);

			$record = mysql_query($sql) or die(mysql_error());
			if ($table = mysql_fetch_assoc($record)) {

        if(password_verify($_POST['password'], $table['password'])){
               print '認証成功';
               //ログイン成功
               $_SESSION['id'] = $table['id'];
               $_SESSION['time'] = time();
               if($_POST['save'] =='on'){
               setcookie('email',$_POST['email'],time()+60*60*24*14);
               setcookie('password',$_POST['password'],time()+60*60*24*14);
               }
               header('Location: channel.php');
           }else{
             $error['login'] = 'error';
           }
			} else {
				$error['login'] = 'failed';
			}
		} else {
			$error['login'] = 'blank';
		}
	}
	?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo $db_conf['439']?>">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo $db_conf['1065']?>">
    <title><?php echo $db_conf['438']?></title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/floating-labels/">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="floating-labels.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->


    <style media="screen">
    :root {
--input-padding-x: .75rem;
--input-padding-y: .75rem;
}

html,
body {
height: 100%;
}

body {
display: -ms-flexbox;
display: -webkit-box;
display: block;
-ms-flex-align: center;
-ms-flex-pack: center;
-webkit-box-align: center;
align-items: center;
-webkit-box-pack: center;
justify-content: center;
padding-top: 40px;
padding-bottom: 40px;
background-color: #f5f5f5;
}

.form-signin {
width: 100%;
max-width: 420px;
padding: 15px;
margin: 0 auto;
}

.form-label-group {
position: relative;
margin-bottom: 1rem;
}

.form-label-group > input,
.form-label-group > label {
padding: var(--input-padding-y) var(--input-padding-x);
}

.form-label-group > label {
position: absolute;
top: 0;
left: 0;
display: block;
width: 100%;
margin-bottom: 0; /* Override default `<label>` margin */
line-height: 1.5;
color: #495057;
border: 1px solid transparent;
border-radius: .25rem;
transition: all .1s ease-in-out;
}

.form-label-group input::-webkit-input-placeholder {
color: transparent;
}

.form-label-group input:-ms-input-placeholder {
color: transparent;
}

.form-label-group input::-ms-input-placeholder {
color: transparent;
}

.form-label-group input::-moz-placeholder {
color: transparent;
}

.form-label-group input::placeholder {
color: transparent;
}

.form-label-group input:not(:placeholder-shown) {
padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
padding-bottom: calc(var(--input-padding-y) / 3);
}

.form-label-group input:not(:placeholder-shown) ~ label {
padding-top: calc(var(--input-padding-y) / 3);
padding-bottom: calc(var(--input-padding-y) / 3);
font-size: 12px;
color: #777;
}
    </style>
  </head>

  <body>


    <form class="form-signin" action="" method="post">

      <div class="text-center mb-4">
       <!-- <img class="mb-4" src="img/EARTH5.jpg" alt="6ch" width="72" height="72">  -->

              <!--Section: Content-->
              <section class="dark-grey-text text-center">

                  <div class="row mx-lg-5 mx-md-3">
                      <div class="col-md-12 mb-4">
                          <img src="https://mdbootstrap.com/img/illustrations/undraw_basketball_agx4.png" class="img-fluid" alt="smaple image">
                      </div>
                  </div>

              </section>
              <!--Section: Content-->


        <!-- <p>Build form controls with floating labels via the <code>:placeholder-shown</code> pseudo-element. <a href="https://caniuse.com/#feat=css-placeholder-shown">Works in latest Chrome, Safari, and Firefox.</a></p>
    -->
    <?php if($error['login'] == 'failed'): ?>
    <p class="error">メールアドレスかパスワードが間違えています。</p>
    <?php endif; ?>
    <?php if($error['login'] == 'error'): ?>
    <p class="error">システムによる問題が発生しました。</p>
    <?php endif; ?>

   </div>

      <div class="form-label-group">
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputEmail">Email address</label>
      </div>

      <div class="form-label-group">
        <input type="password"  name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Password</label>
      </div>

      <div class="checkbox mb-3">
        <fieldset class="form-check">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="save" value="on" id="defaultChecked2" checked>
            <label class="custom-control-label" for="defaultChecked2">次回からは自動的にログインする<</label>
          </div>
        </fieldset>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>

      <p class="mt-4 mb-3 text-muted text-center"><a href="registration.mail.form.php">新規登録はこちら</a>
        <br>&copy; 2017-2018</p>
    </form>
  </body>
</html>
