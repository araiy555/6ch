
<?php
if ($_REQUEST['p'] == 'following') {
      include('profile.following.php');
}elseif ($_REQUEST['p'] == 'comment') {
      include('profile.comment.php');
}elseif ($_REQUEST['p'] == 'data') {
    include('profile.date.php');
}elseif ($_REQUEST['p'] == 'image') {
      include('profile.image.php');
}elseif ($_REQUEST['p'] == 'movie') {
    include('profile.movie.php');
}elseif ($_REQUEST['p'] == 'favorite') {
      include('profile.favorite.php');
}elseif ($_REQUEST['p'] == 'application') {
    include('profile.application.php');
}elseif ($_REQUEST['p'] == 'update') {
    include('kiji.input.php');
}elseif ($_REQUEST['p'] == 'create') {
    include('user.input.php');
}elseif ($_REQUEST['p'] == 'edit') {
    include('date.php');
}else {
      include('main.php');
}



exit;


?>
	<!-- // if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
	// 	$uri = 'https://';
	// } else {
	// 	$uri = 'http://';
	// }
	// $uri .= $_SERVER['HTTP_HOST'];
	// header('Location: '.$uri.'/dashboard/');
	// exit; -->
