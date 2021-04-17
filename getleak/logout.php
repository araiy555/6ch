<?php
session_start();
$_SESSION = array();
// クッキーの破棄
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// セッションクリア
session_destroy();
setcookie('email','',time() -3600);
setcookie('password','',time() -3600);

header('Location: index.php');

?>

<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Earth</title>
  </head>
  <body>
  </body>
</html>
