<?php

require('dbconnect.php');

  if ($_FILES["file_1"]["error"] > 0){

  }else{
        $size = $_FILES['file_1']['size'];
  		$imgData = getimagesize($_FILES['file_1']['tmp_name']);
  	//	print_r($imgData);
  		define ( 'CHECK_WIDTH' , 1500 );
  		define ( 'CHECK_HEIGT' , 500 );
        define ( 'imagesize' , 30000 );
  		if ( $imgData[0] == CHECK_WIDTH ) {
  		   print "画像の横幅は規定のサイズです。";
  		}else{
  		   print "画像の横幅は".CHECK_WIDTH."pxでアップロードしてください。";
  		}

  		if ( $imgData[1] == CHECK_HEIGT ) {
  		   print "画像の縦は規定のサイズです。";

  		}else{
  		   print "画像の縦は".CHECK_HEIGT."pxでアップロードしてください。";
  		}

      if ($size < imagesize) {
           print "画像サイズは規定のサイズです。";
      }else{
        print "画像のサイズは30KB以内でアップロードしてください。";
      }

  		if ($imgData[1] == CHECK_HEIGT and $imgData[0] == CHECK_WIDTH and $size < imagesize) {
      $type = $_FILES["file_1"]["type"];
      $size = $_FILES['file_1']['size'];
      $tmp=$_FILES["file_1"]["tmp_name"];
      $fp = fopen($tmp,'rb');
      $data = bin2hex(fread($fp,$size));
  	 $member_id = $_POST['member_id'];
      try{
          $pdo->exec("INSERT INTO `background`(`type`,`data`,`member_id`) values ('$type',0x$data,'$member_id')");
          $id = $pdo->lastInsertId();
          $pdo = null;
      }catch (PDOException $e){
          echo $e->getMessage();
      }

  }
  }
?>
