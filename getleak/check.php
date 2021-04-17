<?php
session_start();
require('dbconnect.php');
if (!isset($_SESSION['join'])){
	header('Location: touroku.php');
}

// TimeZoneを日本時間に設定する.phpiniにAsia/Tokyo追加
$org_timezone = date_default_timezone_get();
date_default_timezone_set('Asia/Tokyo');

if (!empty($_POST)){
	//登録処理する
	$sql = sprintf('INSERT INTO members SET seibetu="%s",simei="%s", name="%s", kokuseki="%s", email="%s",password="%s",created="%s"',
	mysql_real_escape_string($_SESSION['join']['seibetu']),
	mysql_real_escape_string($_SESSION['join']['simei']),
	mysql_real_escape_string($_SESSION['join']['name']),
	mysql_real_escape_string($_SESSION['join']['kokuseki']),
	mysql_real_escape_string($_SESSION['join']['email']),
	sha1(mysql_real_escape_string($_SESSION['join']['password'])),
	date('Y-m-d H:i;s')
	);

	mysql_query($sql) or die(mysql_error());
	unset($_SESSION['join']);
	header('Location: thanks.php');
}
?>

<!doctype html>
<html>
<head>
  <?php  require_once 'HTML/fabikon.php'; ?>


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

</head>

<body class="grey lighten-4">
  <style media="screen">
  body {
		 font-family: Helvetica, Arial, ;
		 font-size: 12px;

	}
  /*検索ボックス*/
  #keyword{

  background:#eee;/*検索ボックスの背景カラー*/
  }
  </style>
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
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
    </script>



    <?php
    error_reporting(0);
session_start();

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



  <?php require '\navgetion\nav4.php';?>

	  <div class="container">
	<!-- Grid row -->
	<div class="row">

	    <!-- Grid column -->
	    <div class="col-md-12">

</br>
<!--Card-->
<div class="card">

  <!--Card content-->
  <div class="card-body">

    <form action="" method="post">
      <!-- Heading -->
      <h3 class="dark-grey-text text-center">
        <strong>入力内容</strong>
      </h3>
      <hr>

      <form action="" method="post">
      <input type="hidden" name="action" value="submit"/>
      	<dl>
      		<dt>性別</dt>
      		<dd>
      		<?php echo htmlspecialchars($_SESSION['join']['seibetu'],ENT_QUOTES,'UTF-8'); ?>
      		</dl>

      		<dt>氏名</dt>
      		<dd>
      		<?php echo htmlspecialchars($_SESSION['join']['simei'],ENT_QUOTES,'UTF-8'); ?>
      		</dl>

      		<dt>名前</dt>
      		<dd>
      		<?php echo htmlspecialchars($_SESSION['join']['name'],ENT_QUOTES,'UTF-8'); ?>
      		</dl>

      		<dt>国籍</dt>
      		<dd>
      		<?php echo htmlspecialchars($_SESSION['join']['kokuseki'],ENT_QUOTES,'UTF-8'); ?>
      		</dl>
      		<dt>メールアドレス</dt>
      		<dd>
      		<?php echo htmlspecialchars($_SESSION['join']['email'],ENT_QUOTES,'UTF-8'); ?>
      		<d/l>

      		<dt>パスワード</dt>
      		<dd>
      		表示されません。
      		</dd>

      	</dl>


      </from>

      <div class="text-center">
<hr>
        <div><a href="touroku.php?action=rewrite"><button type="button" class="btn btn-default">書き直す</button></a>
      <button type="submit" class="btn btn-primary">登録</button>
        <hr>
      </div>

    </form>
    <!-- Form -->

  </div>

</div>
<!--/.Card-->

</div>
</div>
</div>

</body>

			  <!-- JQuery -->
			  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
			  <!-- Bootstrap tooltips -->
			  <script type="text/javascript" src="js/popper.min.js"></script>
			  <!-- Bootstrap core JavaScript -->
			  <script type="text/javascript" src="js/bootstrap.min.js"></script>
			  <!-- MDB core JavaScript -->
			  <script type="text/javascript" src="js/mdb.min.js"></script>
</html>
