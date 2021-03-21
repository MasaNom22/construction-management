// googleMapsAPIを持ってくるときに,callback=initMapと記述しているため、initMap関数を作成
function initMap() {
    // welcome.blade.phpで描画領域を設定するときに、id=mapとしたため、その領域を取得し、mapに格納します。
    map = document.getElementById("map");
    // 大阪の緯度経度を指定
    let Osaka = {lat: 34.68639, lng: 135.52};
    // オプションを設定
    opt = {
        zoom: 12, //地図の縮尺を指定
        center: Osaka, //センターを大阪に指定
    };
    // 地図のインスタンスを作成します。第一引数にはマップを描画する領域、第二引数にはオプションを指定
    mapObj = new google.maps.Map(map, opt);
}