<?php
include("funcs.php");
$id = $_GET["id"];
$pdo = db_conn();

// 1. 対象のデータ1件を取得
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
    sql_error($stmt);
}else{
    $row = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>データ更新</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        /* index.phpと同じスタイル */
        body { background: #0b1117; color: #fff; font-family: sans-serif; text-align: center; }
        #map { width: 80%; height: 300px; margin: 20px auto; border: 1px solid #ffea00; }
        form { display: inline-block; text-align: left; background: #161b22; padding: 20px; border-radius: 8px; width: 400px; }
        input, textarea { width: 100%; margin-bottom: 10px; background: #000; color: #fff; border: 1px solid #444; padding: 8px; box-sizing: border-box; }
        .update-btn { background: #00f2ff; color: #000; font-weight: bold; border: none; padding: 10px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>🛠 データの更新</h1>
    <div id="map"></div>
    <form method="POST" action="update.php">
        <label>地点名：<input type="text" name="name" value="<?=h($row['name'])?>"></label>
        <label>Email：<input type="text" name="email" value="<?=h($row['email'])?>"></label>
        <label>年齢：<input type="text" name="age" value="<?=h($row['age'])?>"></label>
        <label>緯度：<input type="text" name="lat" id="lat" value="<?=h($row['lat'])?>" readonly></label>
        <label>経度：<input type="text" name="lng" id="lng" value="<?=h($row['lng'])?>" readonly></label>
        <label>コメント：<textarea name="naiyou" rows="4"><?=h($row['naiyou'])?></textarea></label>
        
        <input type="hidden" name="id" value="<?=$row['id']?>">
        <input type="submit" value="更新する" class="update-btn">
    </form>
    
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([<?= $row['lat'] ?>, <?= $row['lng'] ?>], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        let marker = L.marker([<?= $row['lat'] ?>, <?= $row['lng'] ?>]).addTo(map);

        map.on('click', function(e) {
            document.getElementById('lat').value = e.latlng.lat.toFixed(8);
            document.getElementById('lng').value = e.latlng.lng.toFixed(8);
            if(marker) map.removeLayer(marker);
            marker = L.marker(e.latlng).addTo(map);
        });
    </script>
</body>
</html>