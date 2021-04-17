<?php
$db_conf = include_once 'config.php';

error_reporting(0);
session_start();
require('dbconnect.php');


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

           //ログイン成功
           $_SESSION['id'] = $table['id'];
           $_SESSION['time'] = time();
           if($_POST['save'] =='on'){
           setcookie('email',$_POST['email'],time()+60*60*24*14);
           setcookie('password',$_POST['password'],time()+60*60*24*14);
           }
           $login = 'login';
       }
}
}
}
// ログイン状態チェック
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600000000000000000 > time()) {
	$_SESSION['time'] = time();
	$sql=sprintf('SELECT * FROM members WHERE id=%d',
	mysql_real_escape_string($_SESSION['id']));
	$record = mysql_query($sql) or die(mysql_query());
   $member = mysql_fetch_assoc($record);
}
$languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
$languages = array_reverse($languages);
$file= dirname($_SERVER["SCRIPT_NAME"]);


//$local = 'http://localhost';
$local = 'https://getleak.net/';

if ($_GET['p']) {
  $value = $_GET['p'];
}else {
 $value = 'sured';
}
if ($_GET['id']) {
  $id = $_GET['id'];
}

if ($value) {
  if ($value == 'sured') {

    if ($login) {
      if($_GET['page']){
          include(''.$local.''.$file.'/searth.user.main.kiji.php?id='.$id.'&page='.$_GET['page'].'&login='.$member['id'].'&p='.$value.'');
      }else {
       include(''.$local.''.$file.'/searth.user.main.kiji.php?id='.$id.'&login='.$member['id'].'&p='.$value.'');
      }

    }else {
      if($_GET['page']){
          include(''.$local.''.$file.'/searth.user.main.kiji.php?id='.$id.'&page='.$_GET['page'].'&p='.$value.'');
      }else {

             include(''.$local.''.$file.'/searth.user.main.kiji.php?id='.$id.'&p='.$value.'');
      }

    }

  }
  if ($value == 'data') {
    if ($login) {
     include(''.$local.''.$file.'/searth.user.main.data.php?id='.$id.'&login='.$member['id'].'&p='.$value.'');
    }else {
     include(''.$local.''.$file.'/searth.user.main.data.php?id='.$id.'&p='.$value.'');
    }

  }
  if ($value == 'image') {
    if ($login) {
     include(''.$local.''.$file.'/searth.user.main.image.php?id='.$id.'&login='.$member['id'].'&p='.$value.'');
    }else {
     include(''.$local.''.$file.'/searth.user.main.image.php?id='.$id.'&p='.$value.'');
    }
  }

  if ($value == 'movie') {
    if ($login) {
     include(''.$local.''.$file.'/searth.user.main.movie.php?id='.$id.'&login='.$member['id'].'&p='.$value.'');
    }else {
     include(''.$local.''.$file.'/searth.user.main.movie.php?id='.$id.'&p='.$value.'');
    }
  }
  }else {
    if ($login) {
      if($_GET['page']){
          include(''.$local.''.$file.'/searth.user.main.kiji.php?id='.$id.'&page='.$_GET['page'].'&login='.$member['id'].'');
      }else {
       include(''.$local.''.$file.'/searth.user.main.kiji.php?id='.$id.'&login='.$member['id'].'');
      }

    }else {
      if($_GET['page']){
          include(''.$local.''.$file.'/searth.user.main.kiji.php?id='.$id.'&page='.$_GET['page'].'');
      }else {
             include(''.$local.''.$file.'/searth.user.main.kiji.php?id='.$id);
      }

    }

  }


?>
	<!-- // if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
	// 	$uri = 'https://';
	// } else {
	// 	$uri = 'http://';
	// }
	// $uri .= $_SERVER['HTTP_HOST'];
	// header('Location: '.$uri.'/dashboard/');
	// exit; -->
