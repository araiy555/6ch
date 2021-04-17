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
<?php
header('Expires: -1');
header('Cache-Control:');
header('Pragma:');
require('dbconnect.php');

$jibun = $member['id'];

$sql =  sprintf("SELECT  m.id, m.simei, m.name, p.following_id, p.user_id FROM following p, members m  WHERE p.user_id ='%s'  GROUP BY  p.user_id, p.following_id HAVING COUNT(*)>1",
	 mysql_real_escape_string($jibun)
	);
  $record = mysql_query($sql) or die(mysql_error());
?>




<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<title>Earth</title>
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
$(document).ready(function () {
  $('#dtVerticalScrollExample').DataTable({
    "scrollY": "200px",
    "scrollCollapse": true,
  });
  $('.dataTables_length').addClass('bs-select');
});
</script>
</head>

<body>

		<!--Navbar-->
		<nav class="navbar  navbar-expand-lg  navbar-light scrolling-nav bg-white">

		 <!-- Navbar brand -->
		  <a class="navbar-brand" href="taitol.php">
				 <img alt="" src="img/EARTH4.png" width="100" height="30" class="d-inline-block align-top" >
			 </a>
		 <!-- Collapse button -->
		 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
				 aria-expanded="false" aria-label="Toggle navigation">
				 <span class="navbar-toggler-icon"></span>
		 </button>

		 <!-- Collapsible content -->
		 <div class="collapse navbar-collapse" id="basicExampleNav">

				 <!-- Links -->
				 <ul class="navbar-nav mr-auto">
						 <li class="nav-item">
								 <a class="nav-link" href="taitol.php">ホーム
								 </a>
						 </li>

						<!-- <li class="nav-item dropdown">
								 <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">投稿</a>
								 <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
										 <a class="dropdown-item" href="kiji.input.php">投稿</a>
										 <a class="dropdown-item" href="hanbai.php">出品</a>
								 </div>
						 </li>-->
						 <li class="nav-item">
								 <a class="nav-link" href="kiji.input.php">投稿</a>
						 </li>
						 <li class="nav-item">
								 <a class="nav-link" href="ranking.php">ランキング</a>
						 </li>
						 <li class="nav-item">
							 <a class="nav-link" href="main.message.jyusin.php">メール</a>
						 </li>


						 <!-- Dropdown -->
						 <!-- Collapsible content -->
						 <li class="nav-item dropdown">
								 <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
								 <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
										 <a class="dropdown-item" href="settei.php">設定</a>
										 <a class="dropdown-item" href="date.php">プロフィール設定</a>
										 <a class="dropdown-item" href="logout.php">ログアウト</a>
								 </div>
						 </li>

				 </ul>
				 <!-- Links -->

				 <form class="form-inline" action="searth.following.php" method="GET" name="sati" onsubmit="return Check()">
						 <div class="md-form my-0">
								 <input class="form-control mr-sm-2" id="keyword"name="search" value="" type="text" placeholder="Search" aria-label="Search">
						 </div>
				 </form>

		 </div>


	</nav>
	<!--/.Navbar-->
	</br>


		  <div class="container">
		<!-- Grid row -->
		<div class="row">

		    <!-- Grid column -->
		    <div class="col-md-3">


		        <nav class="nav flex-column lighten-4 py-4 font-weight-bold ">

							<a class="list-group-item list-group-item-action waves-effect" href="kiji.main.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i><?php echo $member['simei']; ?><?php echo $member['name']; ?></a>
							<a class="list-group-item list-group-item-action waves-effect" data-toggle="tab" href="#panel555" role="tab" href="main.php"><i class="fa fa-id-card-o" aria-hidden="true"></i>ニュースフィード<span class="sr-only">(current)</span></a>
								<a class="list-group-item list-group-item-action waves-effect" href="data.main.php"><i class="fa fa-table" aria-hidden="true"></i>データ</a>
								<a class="list-group-item list-group-item-action waves-effect" href="gazou.main.php"><i class="fa fa-file-image-o" aria-hidden="true"></i>画像</a>
								<a class="list-group-item list-group-item-action waves-effect" href="douga.main.php"><i class="fa fa-file-movie-o" aria-hidden="true"></i>動画</a>
								<a class="list-group-item list-group-item-action waves-effect" href="syoseki.main.php"><i class="fa fa-leanpub" aria-hidden="true"></i>書籍</a>
							<!--	<a class="list-group-item list-group-item-action waves-effect" href="hanbai.main.php"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>ショップ</a>-->
								<a class="list-group-item list-group-item-action waves-effect" href="friend.php">
	<i class="fa fa-frown-o" aria-hidden="true"></i>
	フォロー/フォロワー</a>


		        </nav>


						</div>
						<div class="col-md-9">
							<?php
							$kml = mysql_num_rows($record);

							if($kml == 0){
						echo '<img src="img/error.jpg" width="100%" height="50%"   alt="検索条件にヒットするデータが見つかりませんでした">';
							exit;
							}else{
							}
							?>
			<table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="th-sm">Name
							<i class="fa fa-sort float-right" aria-hidden="true"></i>
						</th>
						<th class="th-sm">Position
							<i class="fa fa-sort float-right" aria-hidden="true"></i>
						</th>
						<th class="th-sm">Office
							<i class="fa fa-sort float-right" aria-hidden="true"></i>
						</th>
						<th class="th-sm">Age
							<i class="fa fa-sort float-right" aria-hidden="true"></i>
						</th>
						<th class="th-sm">Start date
							<i class="fa fa-sort float-right" aria-hidden="true"></i>
						</th>
						<th class="th-sm">Salary
							<i class="fa fa-sort float-right" aria-hidden="true"></i>
						</th>
					</tr>
				</thead>



				<?php
				while($messages = mysql_fetch_assoc($record)):
				?>


			<?php

			require('dbconnect.php');

			$aite = $messages['following_id'];


			$sql = "SELECT id,simei,name FROM members WHERE id IN ('$aite');" ;
			  $following = mysql_query($sql) or die(mysql_error());
			?>









				<?php
				while($aki = mysql_fetch_assoc($following)):
				?>


					<tbody>
						<tr>
							<td>	<?php echo $aki['simei']; ?><?php echo $aki['name']; ?></br>
</td>
							<td>System Architect</td>
							<td>Edinburgh</td>
							<td>61</td>
							<td>2011/04/25</td>
							<td>$320,800</td>
						</tr>








			<?php
				endwhile;
				?>





			<?php
				endwhile;
				?>
			</table>



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
