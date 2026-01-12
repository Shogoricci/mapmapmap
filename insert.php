<?php
include("funcs.php");
$pdo = db_conn();

// 1. POSTデータ取得
$name   = $_POST["name"];
$email  = $_POST["email"];
$age    = $_POST["age"];
$naiyou = $_POST["naiyou"];
$lat    = $_POST["lat"];
$lng    = $_POST["lng"];

// 2. SQL作成（gs_bm_table）
$sql = "INSERT INTO gs_bm_table(name,email,age,naiyou,lat,lng,indate) VALUES(:name,:email,:age,:naiyou,:lat,:lng,sysdate())";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':name',   $name,   PDO::PARAM_STR);
$stmt->bindValue(':email',  $email,  PDO::PARAM_STR);
$stmt->bindValue(':age',    $age,    PDO::PARAM_INT);
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);
$stmt->bindValue(':lat',    $lat,    PDO::PARAM_STR);
$stmt->bindValue(':lng',    $lng,    PDO::PARAM_STR);

$status = $stmt->execute();

// 3. 処理後
if($status==false){
    sql_error($stmt);
}else{
    // 一覧画面へ移動
    redirect("select.php");
}