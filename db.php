<?php
// さくらのコントロールパネル「データベース」からコピペして埋める
$host   = 'mysql3112.db.sakura.ne.jp';   // ←例：mysql***.db.sakura.ne.jp
$dbname = 'shogoritchiito_sakurabase';            // ←DB名
$user   = 'shogoritchiito_sakurabase';                 // ←rootではない
$pass   = 'Shogo1393';                 // ←空ではない

try {
    $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // 例外を投げる
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
    return $pdo;

} catch (PDOException $e) {
    // 本番では詳細を出さない方が良いが、今は原因特定のため出す
    die("DB接続エラー: " . $e->getMessage());
}