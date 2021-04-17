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
            if(isset($_FILES['file'])){

                $name = $_FILES['file']['name'];
                $type = explode('.',$name);
                $type = end($type);
                $size = $_FILES['file']['size'];
                $tmp = $_FILES['file']['tmp_name'];
                $random_name = rand();
		$member_id = $member['id'];
                if($type != 'mp4' && $type != 'MP4'){
                    $message = "This format is not supported.";
                }else{
                    move_uploaded_file($tmp,'files/'.$random_name.'.'.$type);
                    try{
                         $pdo = new PDO('mysql:host=localhost; dbname=mini_bbs;','root','1234');
                       $stmt = $pdo -> prepare ("INSERT INTO douga VALUES('','$name','files/$random_name.$type','$member_id')");
                        $stmt -> execute();

                        $message = "Succesfully Uploaded.";

                    }catch(PDOException $e){
                        exit('failed connecting to DB.'.$e -> getMessage());
                    }
                }

                echo "$message <br/><br/>";
            }
        ?>