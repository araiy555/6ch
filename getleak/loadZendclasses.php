<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SimpleAPI "Wikipedia" test</title>
</head>
<body>
    <h1>SimpleAPI "Wikipeadia" test</h1>
 
  	<form action="" name="search1" method="GET">
	<dl class="search1">
		<dt><input type="text" name="search" value="" placeholder="Earth‚ÌŒŸõ‚Ü‚½‚Íl•¨" autocomplete="off"/></dt>
	
	</dl>
</form>
 
 
    <br>
 
<?php
    if (isset($_GET['search'])) {
        $keyword = urlencode($_GET['search']);
        $url = "http://wikipedia.simpleapi.net/api?keyword=".$keyword."&output=xml";
        $xml = simplexml_load_file($url);
        if ($xml) {
            echo $xml->result->name;
        }
        else {
            echo "simplexml_load_file‚ÅƒGƒ‰[";
        }
    }
?>
</body>
</html>