
<?php
function db_connect(){
  $dsn = "mysql:dbname=earthwork_sample;host=mysql5027.xserver.jp;charset=utf8";
  $user = 'earthwork_arai';
  $password = 'q1w2e3r4';
  // $dsn = 'mysql:host=localhost;dbname=mini_bbs;charset=utf8';
  // $user = 'root';
  // $password = '1234';

	try{
		$dbh = new PDO($dsn, $user, $password);
		return $dbh;
	}catch (PDOException $e){
	    	print('Error:'.$e->getMessage());
	    	die();
	}
}
?>
