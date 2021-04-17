

<?php
$url = 'http://api.openweathermap.org/data/2.5/weather?q=東京,jp&appid=6aa27136cd989af4964e13c7ba76b142';
$weather = json_decode(file_get_contents($url), true);
$weatherShow = '<div>天気:%s</div>
<div>天気詳細:%s</div>
<div><img src="http://openweathermap.org/img/w/%s.png" style="width:50px"></div>
<div>温度:%s 度</div>
<div>湿度:%s パーセント</div>
<div>風速:%sメートル</div>';
 
echo sprintf($weatherShow,$weather['weather'][0]['main'], $weather['weather'][0]['description'], $weather['weather'][0]['icon'], $weather['main']['temp'], $weather['main']['humidity'], $weather['wind']['speed']);

?>



<?php
$url = 'http://api.openweathermap.org/data/2.5/forecast?q=tokyo,jp&appid=6aa27136cd989af4964e13c7ba76b142';
$weather = json_decode(file_get_contents($url), true);


$weatherShow = '<div>天気:%s</div>

<div>天気詳細:%s</div>
<div><img src="http://openweathermap.org/img/w/%s.png" style="width:50px"></div>
<div>温度:%s 度</div>
<div>湿度:%s パーセント</div>
<div>風速:%sメートル</div>';

	$array = array(1,2,3,4,5);
 
foreach ($array as &$weather){
		echo sprintf($weatherShow, $weather['weather'][0]['main'], $weather['weather'][0]['description'], $weather['weather'][0]['icon'], $weather['main']['temp'], $weather['main']['humidity'], $weather['wind']['speed']);


}
?>