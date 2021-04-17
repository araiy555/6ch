<?php
session_start();
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
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Vertical Responsive Menu - Demonstration</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
  <link href='../src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="demo.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />

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
									<input type="text" class="form-control" id="keyword"name="search" value="<?php echo $name;?>" value="" placeholder="Earthの検索またはチャンネル">
					</form>


		</section>
		<section class="earth3">
		<a href="login.php" ><img src="img/user.png" alt="<?php echo $member['simei']; ?><?php echo $member['name']; ?>"  title="<?php echo $member['simei']; ?><?php echo $member['name']; ?>" style="border-radius: 100px;"  align="middle"width="4%" height="5%" vspace="10"hspace="5"></a>


		</section>
  </header>

  <nav class="vertical_nav">
    <ul id="js-menu" class="menu">


			<li class="menu--item">
				<a href="../../taitol.php" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">ホーム</span>
				</a>
			</li>



      <li class="menu--item  menu--item__has_sub_menu">

        <label class="menu--link" title="Item 1">
          <i class="menu--icon  fa fa-fw fa-user"></i>
          <span class="menu--label">データ</span>
        </label>


        <ul class="sub_menu">

          <li class="sub_menu--item">
            <a href="date.php" class="sub_menu--link">プロフィール編集</a>
          </li>

        </ul>
      </li>



      <li class="menu--item  menu--item__has_sub_menu">

        <label class="menu--link" title="Item 1">
          <i class="menu--icon  fa fa-fw fa-user"></i>
          <span class="menu--label">記事</span>
        </label>


        <ul class="sub_menu">


					<li class="sub_menu--item">
						<a href="kiji.input.php" class="sub_menu--link">投稿</a>
					</li>


          <li class="sub_menu--item">
            <a href="kiji.main.php" class="sub_menu--link">投稿一覧</a>
          </li>



          <li class="sub_menu--item">
            <a href="main.php" class="sub_menu--link">コメント</a>
          </li>
          <li class="sub_menu--item">
            <a href="#" class="sub_menu--link">編集</a>
          </li>
        </ul>
      </li>



      <li class="menu--item">
        <a href="gazou.main.php" class="menu--link" title="Item 2">
          <i class="menu--icon  fa fa-fw fa-briefcase"></i>
          <span class="menu--label">写真</span>
        </a>
      </li>

      <li class="menu--item">
        <a href="douga.main.php" class="menu--link" title="Item 3">
          <i class="menu--icon  fa fa-fw fa-cog"></i>
          <span class="menu--label">動画</span>
        </a>
      </li>
      <li class="menu--item  menu--item__has_sub_menu">

        <label class="menu--link" title="Item 4">
          <i class="menu--icon  fa fa-fw fa-database"></i>
          <span class="menu--label">ショッピング</span>
        </label>

        <ul class="sub_menu">



          <li class="sub_menu--item">
            <a href="hanbai.main.php" class="sub_menu--link">出品</a>
          </li>
					<li class="sub_menu--item">
						<a href="hanbai.main.php" class="sub_menu--link">出品一覧</a>
					</li>
          <li class="sub_menu--item">
            <a href="#" class="sub_menu--link">コメント</a>
          </li>
          <li class="sub_menu--item">
            <a href="#" class="sub_menu--link">編集</a>
          </li>
        </ul>
      </li>






      <li class="menu--item  menu--item__has_sub_menu">

        <label class="menu--link" title="Item 4">
          <i class="menu--icon  fa fa-fw fa-database"></i>
          <span class="menu--label">プロジェクト</span>
        </label>

        <ul class="sub_menu">

					<li class="sub_menu--item">
						<a href="situmon.main.php" class="sub_menu--link">投稿</a>
					</li>

          <li class="sub_menu--item">
            <a href="situmon.main.php" class="sub_menu--link">質問</a>
          </li>
          <li class="sub_menu--item">
            <a href="sigoto.main.php" class="sub_menu--link">依頼</a>
          </li>
          <li class="sub_menu--item">
            <a href="#" class="sub_menu--link">イベント</a>
          </li>
          <li class="sub_menu--item">
            <a href="#" class="sub_menu--link">求人</a>
          </li>
          <li class="sub_menu--item">
            <a href="#" class="sub_menu--link">広告</a>
          </li>
        </ul>
      </li>

      <li class="menu--item">
        <a href="friend.php" class="menu--link" title="Item 5">
          <i class="menu--icon  fa fa-fw fa-globe"></i>
          <span class="menu--label">フォロー/フォロワー</span>
        </a>
      </li>
			<li class="menu--item  menu--item__has_sub_menu">

				<label class="menu--link" title="Item 4">
					<i class="menu--icon  fa fa-fw fa-database"></i>
					<span class="menu--label">メッセージ</span>
				</label>

				<ul class="sub_menu">
					<li class="sub_menu--item">
						<a href="main.message.jyusin.php" class="sub_menu--link">受信</a>
					</li>
					<li class="sub_menu--item">
						<a href="main.message.php" class="sub_menu--link">送信</a>
					</li>
					<li class="sub_menu--item">
						<a href="#" class="sub_menu--link">編集</a>
					</li>
				</ul>
			</li>


      <li class="menu--item">
        <a href="ranking.php" class="menu--link" title="Item 5">
          <i class="menu--icon  fa fa-fw fa-globe"></i>
          <span class="menu--label">ランキング</span>
        </a>
      </li>
      <li class="menu--item">
        <a href="settei.php" class="menu--link" title="Item 5">
          <i class="menu--icon  fa fa-fw fa-globe"></i>
          <span class="menu--label">設定</span>
        </a>
      </li>
			<li class="menu--item">
				<a href="ranking.php" class="menu--link" title="Item 5">
					<i class="menu--icon  fa fa-fw fa-globe"></i>
					<span class="menu--label">お支払い</span>
				</a>
			</li>




      <li class="menu--item">
        <a href="../../logout.php" class="menu--link" title="Item 5">
          <i class="menu--icon  fa fa-fw fa-globe"></i>
          <span class="menu--label">ログアウト</span>
        </a>
      </li>




    </ul>

    <button id="collapse_menu" class="collapse_menu">
      <i class="collapse_menu--icon  fa fa-fw"></i>
      <span class="collapse_menu--label">Recolher menu</span>
    </button>

  </nav>


  <div class="wrapper">

  <section class="contents__inner2">
			<?php
			error_reporting(0);
			?>


				<section class="contents">
					<section class="contents">
			     <form action="hanbai.toukou.php" method="post" enctype="multipart/form-data">
				<table id="contact-form" border="1" cellpadding="0" cellspacing="0">
			<tr>
				<th>
				カテゴリ
				</th>

			<td><select  name="kategori" id="kokuseki"  maxlength="255"  value="<?php echo htmlspecialchars($_POST['kategori'],ENT_QUOTES,'UTF-8'); ?>"/>
				<OPTGROUP label="カテゴリ">
			<OPTION value="食品">食品</OPTION>
			<OPTION value="漫画">漫画</OPTION>
			<OPTION value="小説">小説</OPTION>
			<OPTION value="スポーツ">スポーツ</OPTION>
			<OPTION value="IT・科学">IT・科学</OPTION>
			<OPTION value="料理">料理</OPTION>
			<OPTION value="スポーツ">スポーツ</OPTION>
			<OPTION value="アニメ">アニメ</OPTION>
			<OPTION value="漫画">漫画</OPTION>
			<OPTION value="小説">小説</OPTION>
				<OPTION value="音楽">音楽</OPTION>
			<OPTION value="芸能人">芸能人</OPTION>
			<OPTION value="有名人">有名人</OPTION>
			<OPTION value="ファッション">ファッション</OPTION>
			<OPTION value="IT">IT</OPTION>
			<OPTION value="面白">面白</OPTION>
				</OPTGROUP>
			</select>
				</td>
				</tr>



			<tr>
				<th>
				タイトル
				</th>


			<td>
				<input type="text" name="taitol" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['taitol'],ENT_QUOTES,'UTF-8'); ?>"/>

			</td>
			</tr>

			<th>
			メイン画像
			</th>
			<td>
			<input type="file" name="file" id="file"value="<?php echo htmlspecialchars($_FILES['file'],ENT_QUOTES,'UTF-8'); ?>"/>
			</td>
		</tr>

			<tr>
				<th>
				内容
				</th>


			<td>
				<input type="text" name="taitol" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['taitol'],ENT_QUOTES,'UTF-8'); ?>"/>

			</td>
			</tr>




			<tr>
				<th>
				購買URL
				</th>
				<td>
				<input type="text" name="URL" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['URL'],ENT_QUOTES,'UTF-8'); ?>"/>
				</td>
			</tr>
			<tr>
				<th>
				値段
				</th>
				<td>
				<input type="text" name="nedan" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['nedan'],ENT_QUOTES,'UTF-8'); ?>"/>
				</td>
			</tr>
				<th>
				連絡先
				</th>
				<td>
				<input type="text" name="nedan" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['nedan'],ENT_QUOTES,'UTF-8'); ?>"/>
				</td>
			</tr>
			<th>
				メールアドレス
				</th>
				<td>
				<input type="text" name="nedan" size="35" maxlength="255"  value="<?php echo htmlspecialchars($_POST['nedan'],ENT_QUOTES,'UTF-8'); ?>"/>
				</td>
			</tr>

			<tr>
				<th colspan="2">
				<input type="submit" name="submit" value="投稿"/>
				</th>
			</tr>
			</table>
			</form>
				</section>
					</section>
    </section>

  </div>

  <script src="../dist/vertical-responsive-menu.min.js"></script>

</body>
</html>
