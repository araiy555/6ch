<?php
session_start();
error_reporting(0);
require('dbconnect.php');
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
if($_REQUEST){
  if($_REQUEST['Completion'] === '1' )
  {
    $completion = '登録完了しました。';
  }
  if($_REQUEST['error'] === '1' )
  {
    $completion = '問題が発生しました。';
  }
}
// if($_REQUEST['fileerror'] === '2')
// {
//   $completion = 'ファイルに問題があります。';
// }
// if ($_REQUEST['extension'] === '3')
// {
//   $completion = '拡張子に問題があります。';
// }

			if(!empty($_POST)){
			//エラー項目の確認
			if(empty($error)){
			$_SESSION['join'] = $_POST;
header('Location: date.kakunin.php');
			}
		}
			//書き直しコード
			//書き直しコードif ($_REQUEST['action'] == 'rewrite') {
			 // $_POST = $_SESSION['join'];
			 // $error['rewrite'] = true;
			//}

		?>


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
		require('dbconnect.php');


		$id = $member['id'];


		$sql = "select member_id from profile where member_id='$id' ORDER BY modified DESC LIMIT 1" ;
		  $arai = mysql_query($sql) or die(mysql_error());

			$jibun = $member['id'];

			$sql =  sprintf("SELECT  m.id, m.simei, m.name, p.following_id, p.user_id FROM following p, members m WHERE p.user_id ='%s'  GROUP BY  p.user_id, p.following_id HAVING COUNT(*)>1",
				 mysql_real_escape_string($jibun)
				);
			  $record = mysql_query($sql) or die(mysql_error());



		?>


    <?php $db_conf = include_once 'config.php';?>



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
<style media="screen">
body {
	 font-family: Helvetica, Arial;
	 font-size: 12px;
	background-color: #e6ecf0;

}
/*検索ボックス*/
#keyword{
background:#eee;/*検索ボックスの背景カラー*/
}
</style>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-3098455471706304",
    enable_page_level_ads: true
  });
</script>
</head>

<body class="grey lighten-4">


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

                      <?php require 'navgetion/nav4.php';?>
	  <div class="container">
	<!-- Grid row -->
	<div class="row">





					<div class="col-md-8">
<?php if ($completion): ?>
<br>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong><?php echo $completion;?></strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif; ?>
<br>
		<form action="" method="post" anctype="multipart/form-data">


			<div class="card ">
					<div class="card-header">
            <nav>
         <div class="nav nav-tabs md-tabs" id="nav-tab" role="tablist">
         <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
         aria-controls="nav-home" aria-selected="true">設定</a>
         <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
         aria-controls="nav-profile" aria-selected="false">プロフィール画像</a>
         <a class="nav-item nav-link" id="nav-image-tab" data-toggle="tab" href="#nav-image" role="tab"
         aria-controls="nav-profile" aria-selected="false">プロフィール背景</a>
         </div>
         </nav>


          </div>
					<div class="card-body">

            <div class="tab-content " id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                  <div class="form-group">
                       <label class="col-sm-2 control-label">国籍 <span class="label label-danger"></span></label>
                     <div class="col-sm-10">
                  <select class="custom-select browser-default" name="tosi" id="tosi" placeholder="職歴" value="<?php echo $member['tosi']; ?>"required/>


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
             </div>
                <div class="form-group">
                     <label class="col-sm-2 control-label">自己紹介 <span class="label label-danger"></span></label>
                   <div class="col-sm-10">
                  <textarea type="text" name="message" class="form-control"placeholder="自己紹介"value="<?php echo $member['message']; ?>"required/></textarea>
                 </div>
                </div>

                    </br>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">URL<span class="label label-danger"></span></label>

                    <div class="col-sm-10">
                      <input type="text" name="url" autocomplete="url" placeholder="URL" class="form-control" value="<?php echo $member['url']; ?>"required/>
                     </div>
                    </div>
                    </br>

                      <div class="form-group">
                       <label class="col-sm-2 control-label">電話番号<span class="label label-danger"></span></label>

                      <div class="col-sm-10">
                      <input type="text" name="renrakubango" autocomplete="tel"placeholder="連絡番号"class="form-control"value="<?php echo $member['renrakubango']; ?>"required/>

                      </div>
                    </div>
                    </br>
                        <div class="form-group">
                         <label class="col-sm-4 control-label">メールアドレス<span class="label label-danger"></span></label>

                        <div class="col-sm-10">
                      <input type="text" name="renrakuadoresu" autocomplete="email"class="form-control"placeholder="メールアドレス"value="<?php echo $member['renrakuadoresu']; ?>"required/>

                      </div>
                    </div>
                    </br>
                        <div class="col-sm-10">
                          <label class="col-sm-2 control-label">職業<span class="label label-danger"></span></label>


                              <select class="custom-select browser-default" name="job" id="job" placeholder="職業" value="<?php echo $member['job']; ?>"required/>


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
                <br>

                <div class="col-sm-10">
                  <label class="col-sm-4 control-label">職歴<span class="label label-danger"></span></label>


                <select class="custom-select browser-default" name="syokureki" id="syokureki" placeholder="職歴" value="<?php echo $member['syokureki']; ?>"required/>

                  <OPTION value="<?php echo $member['syokureki']; ?>">
                <?php if($member['syokureki']){
                    echo $member['syokureki'];
                  }else{
                    echo '職歴を入力してください';
                  }
                  ?>
                </OPTION>
                <?php
                for($i = 1; $i<=100; $i++):?>

                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php endfor;?>

                </select>
                </div>
                <br>
                <div class="col-sm-10">
                  <label class="col-sm-4 control-label">年齢<span class="label label-danger"></span></label>


                <select class="custom-select browser-default" name="tosi" id="tosi" placeholder="職歴" value="<?php echo $member['tosi']; ?>"required/>


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
               <div class="col-sm-offset-2 col-sm-10">
                   <input type="submit" class="btn btn-default"value="登録"/>
                 </div>
                     </div>


</form>
         </div>

              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <br>
                <form action="profile.check.php" method="post" enctype="multipart/form-data"  accept="image/*">
                <input type="file" name="file" id="file"/>
                <input type="submit" value="OK"/>
                </form>
                <p>画像の横幅は400pxでアップロードしてください。画像の縦は400pxでアップロードしてください</p>
                <br>
                  				<?php

                  				$kml = mysql_num_rows($arai);

                  				if($kml == 0){

                  							echo "<img class='boxbox' src='img/noimage.png'  width='40%' style='border-radius: 200px;' alt='読み込み中…'>";

                  				}else{


                  				}
                  				?>

                  				<?php if (!empty($images)): ?>

                  				<?php foreach ($images as $i => $img): ?>
                  				<?php if ($i): ?>

                  				<?php endif; ?>

                  				<div class="photo">

                  								<a href="profile.php">	<img class="boxbox" src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>" width="10%" style="border-radius: 200%;" alt="読み込み中…"></a>

                  							</div>
                  							<!-- Card image-->
                  						<?php endforeach; ?>

                  						<?php endif; ?>




              </div>
              <div class="tab-pane fade" id="nav-image" role="tabpanel" aria-labelledby="nav-profile-tab">
                <form action="background.check.php" method="post" enctype="multipart/form-data"  accept="image/*">
                <input type="file" name="file" id="file"/>
                <input type="submit" value="OK"/>
                </form>
                <p>画像の横幅は1500pxでアップロードしてください。画像の縦は500pxでアップロードしてください。</p>
                <br>
                <?php require_once 'background.top.php';?>

                <?php

                $kml = mysql_num_rows($error);

                if($kml == 0){

                      echo "<img class='background' src='img/black.jpg'  width='100%'  alt='読み込み中…'>";

                }else{


                }
                ?>

                <?php if (!empty($background)): ?>

                <?php foreach ($background as $i => $img): ?>
                <?php if ($i): ?>

                <?php endif; ?>

                <a href="background.php">	<img class="background" src="data:image/jpeg;base64,<?=base64_encode($img['data'])?>" width="100%" alt="読み込み中…"></a>

                      <!-- Card image-->
                    <?php endforeach; ?>

                    <?php endif; ?>
              </div>

            </div>




<br>




					</div>
					</div>





				</div>

        <div class="col-md-4 d-none d-sm-block">
            <?php require_once('right-menu.php');?>
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
</html>
