<?php
// XSS対策
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// DB接続
function db_conn() {
    try {
        $db_name = "shogoritchiito_sakurabase"; // データベース名
        $db_host = "mysql3112.db.sakura.ne.jp"; // ホスト名
        $db_id   = "shogoritchiito_sakurabase"; // さくらのDBユーザ名
        $db_pw   = "Shogo1393"; // さくらのDBパスワード

        // エラーを表示する設定を追加
        $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}

// SQLエラー
function sql_error($stmt) {
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

// リダイレクト
function redirect($file_name) {
    header("Location: ".$file_name);
    exit();
}