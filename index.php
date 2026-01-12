<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Map Bookmark - 登録</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        body { background: #050a0f; color: #e0f7fa; font-family: sans-serif; display: flex; flex-direction: column; align-items: center; }
        #map { width: 80%; height: 400px; border: 2px solid #00f2ff; margin-top: 20px; }
        form { background: rgba(16,25,36,0.9); padding: 20px; margin-top: 20px; width: 400px; border-radius: 8px; }
        input, textarea { width: 100%; padding: 8px; margin-bottom: 10px; background: #000; color: #fff; border: 1px solid #444; }
        input[type="submit"] { background: #00f2ff; color: #000; font-weight: bold; cursor: pointer; }
        nav { margin-top: 10px; }
        nav a { color: #00f2ff; }
    </style>
</head>
<body>
    <h1>📍 MAP DEPLOY</h1>
    <nav><a href="select.php">データ一覧を見る</a></nav>

    <div id="map"></div>

    <form method="POST" action="insert.php">
        <label>地点名：<input type="text" name="name" required></label>
        <label>Email：<input type="text" name="email"></label>
        <label>年齢：<input type="text" name="age"></label>
        <label>緯度：<input type="text" name="lat" id="lat" readonly></label>
        <label>経度：<input type="text" name="lng" id="lng" readonly></label>
        <label>コメント：<textarea name="naiyou" rows="4"></textarea></label>
        <input type="submit" value="送信">
    </form>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([35.6895, 139.6917], 5);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        map.on('click', function(e) {
            document.getElementById('lat').value = e.latlng.lat.toFixed(8);
            document.getElementById('lng').value = e.latlng.lng.toFixed(8);
        });
    </script>
</body>
</html>