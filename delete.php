<?php
include("funcs.php");
$id = $_GET["id"];
$pdo = db_conn();

// テーブル名を gs_bm_table に指定
$stmt = $pdo->prepare("DELETE FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){ sql_error($stmt); }else{ redirect("select.php"); }