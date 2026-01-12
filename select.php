<?php
include("funcs.php");
$pdo = db_conn();

// 1. データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table ORDER BY id DESC");
$status = $stmt->execute();

// 2. データ表示
$view = "";
$locations = [];
if($status==false) {
    sql_error($stmt);
} else {
    while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .= '<div class="card">';
        $view .= '<h3>'.h($r["name"]).'</h3>';
        $view .= '<p>'.h($r["naiyou"]).'</p>';
        $view .= '<div class="btns">';
        $view .= '<a href="detail.php?id='.$r["id"].'" class="edit-btn">更新</a> ';
        $view .= '<a href="delete.php?id='.$r["id"].'" class="del-btn" onclick="return confirm(\'削除しますか？\')">削除</a>';
        $view .= '</div>';
        $view .= '</div>';
        $locations[] = $r;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>データ一覧</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        body { background: #0b1117; color: #fff; font-family: sans-serif; padding: 20px; }
        #map { width: 100%; height: 300px; margin-bottom: 20px; border: 1px solid #00f2ff; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 15px; }
        .card { background: #161b22; padding: 15px; border-radius: 8px; border-left: 5px solid #00f2ff; }
        .btns { margin-top: 10px; }
        a { text-decoration: none; color: #00f2ff; margin-right: 10px; font-size: 0.8rem; }
        .del-btn { color: #ff3333; }
        .nav-link { display: block; margin-bottom: 20px; color: #00f2ff; }
    </style>
</head>
<body>
    <h1>📍 データ一覧</h1>
    <a href="index.php" class="nav-link">← 登録画面に戻る</a>
    <div id="map"></div>
    <div class="grid"><?= $view ?></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([36.2048, 138.2529], 5);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        const data = <?= json_encode($locations) ?>;
        data.forEach(l => {
            if(l.lat && l.lng) L.marker([l.lat, l.lng]).addTo(map).bindPopup(l.name);
        });
    </script>
</body>
</html>