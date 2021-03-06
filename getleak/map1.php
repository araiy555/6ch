<html>
<head>
<meta charset="utf-8"/>
<title>Leaflet.js</title>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.js"></script>
<script>
//. 船橋市役所の緯度経度（初期位置）
var lat = 35.69471100;
var lng = 139.98262100;

var map = null;
var marker = null;

$(function(){
  //. 船橋市役所を中心とした地図を OpenStreetMap データで表示
  map = L.map('demoMap').setView( [ lat, lng ], 15 );
  L.tileLayer(
    'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data &copy; <a href="http://openstreetmap.org/">OpenStreetMap</a>',
      maxZoom: 18
    }
  ).addTo( map );

  //. 初期状態で市役所にマーカーを設置
  marker = L.marker( [ lat, lng ] ).addTo( map );

  //. マーカーを２秒おきにランダムウォークさせる
  setInterval( randomWalk, 2000 );
});

function randomWalk(){
  //. マーカー位置をランダムに移動
  lat += Math.random() / 100.0 - 0.005;
  lng += Math.random() / 100.0 - 0.005;
  var latlng = new L.LatLng( lat, lng );
  marker.setLatLng( latlng );
}
</script>
<style>
html, body  {
	width: 100%;
	height: 100%;
	padding: 0px;
	margin: 0px;
}
#demoMap {
	width: 100%;
	height: 100%;
}
</style>
</head>
<body>
<div id="demoMap"></div>


</body>
</html>
