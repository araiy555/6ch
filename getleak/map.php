<!DOCTYPE>
<html lang="ja">
<head>
    <meta charset="utf-8" />
    <title>getTilt / setTilt メソッド | 設置サンプル</title>
    <!-- スマートフォン向けviewportの指定 -->
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <!-- Google Maps APIの読み込み -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript">
        var map;
        //初期設定
        function initialize() {
            var deg=rchk();
            /* 緯度・経度：サンタ・クルーズ・ビッグ・ツリーズ & パシフィック・レイルウェイ＝ボードウォーク駅 3rd St, サンタクルーズ カリフォルニア 95060 アメリカ合衆国 */
            var latlng=new google.maps.LatLng(36.31512514748051,140.2734375);
            /* 地図のオプション設定 */
            var myOptions = {
                /*初期のズーム レベル */
                zoom: 18,
                /* 地図の中心点 */
                center:latlng,
                /* 地図タイプ */
                mapTypeId: google.maps.MapTypeId.SATELLITE,
                setTile:deg,
                  disableDefaultUI:true
            };
            map=new google.maps.Map(document.getElementById("map"), myOptions);
        }
        //チェック
        function rchk(){
            var deg=0;
            var obj=document.getElementsByName("deg");
            for(var i=0; i<obj.length; i++){
                if(obj[i].checked){
                    deg=parseInt(obj[i].value);
                }
            }
            return deg;
        }
        function tpchk(){
            var tp=0;
            var obj=document.getElementsByName("tp");
            for(var i=0; i<obj.length; i++){
                if(obj[i].checked){
                    tp=obj[i].value;
                }
            }
            if(tp=="HYBRID"){
                map.setMapTypeId(google.maps.MapTypeId.HYBRID);
            }else if(tp=="SATELLITE"){
                map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
            }
            return tp;
        }
        //地図タイプ設定
        function setType(){
            map.mapTypeId(tpchk());
            console.log(map.getMapTypeId());
        }
        //地図の傾き設定
        function setTileDeg(){
            map.setTilt(rchk());
            console.log(map.getTilt());
        }
        //地図の緯度・経度設定
        function setLatLng(lat,lng){
            var latlng=new google.maps.LatLng(lat, lng);
            map.setCenter(latlng);
        }
    </script>
    <style type="text/css">
        * { margin:0; padding:0; font-size:12px; }
        html, body { margin:0; padding:0; }
        h1, p { margin:10px; }
        #map { width:100%; height:500px; }
    </style>
</head>
<body onload="initialize()">
    <h1>getTilt / setTilt メソッド</h1>
    <form id="frm" name="frm">
        <p>
            地図のタイプ：
            <label for="tp_1"><input type="radio" name="tp" id="tp_1" value="HYBRID" onclick="setType()" />HYBRID</label>
            <label for="tp_2"><input type="radio" name="tp" id="tp_2" value="SATELLITE" checked="checked" onclick="setType()" />SATELLITE</label>
            　/　
            地図の傾き：
            <label for="deg_1"><input type="radio" name="deg" id="deg_1" value="0" onclick="setTileDeg()" />0</label>
            <label for="deg_2"><input type="radio" name="deg" id="deg_2" value="45" checked="checked" onclick="setTileDeg()" />45</label>
            <br>
            緯度・経度：
            <label for="lt_1"><input type="radio" name="lt" id="lt_1" value="0" checked="checked" onclick="setLatLng(36.964758,-122.015539)" />ｻﾝﾀ･ｸﾙｰｽﾞ･ﾋﾞｯｸﾞ･ﾂﾘｰｽﾞ & ﾊﾟｼﾌｨｯｸ･ﾚｲﾙｳｪｲ=ﾎﾞｰﾄﾞｳｫｰｸ駅</label>
            <label for="lt_2"><input type="radio" name="lt" id="lt_2" value="45" onclick="setLatLng(36.964436,-122.017623)" />ﾎﾞｰﾄｳｫｰｸ ｻﾝﾀ･ｸﾙｰｽﾞ</label>
        </p>
    </form>
    <!-- 地図の埋め込み表示 -->
    <div id="map"></div>
</body>
</html>