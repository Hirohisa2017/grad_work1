<?php
session_start();
$name = $_POST['name'];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$kanri_flg = $_POST["kanri_flg"];
$life_flg = $_POST["life_flg"];

require_once('funcs.php');

//1. 接続します
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "INSERT INTO gs_user_table(id, name, lid, lpw, kanri_flg, life_flg) VALUES (null,:name, :lid, :lpw, :kanri_flg, :life_flg)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw,  PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', $life_flg,  PDO::PARAM_INT);
$res = $stmt->execute();

//SQL実行時にエラーがある場合
if($res==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
} else{
    //５．index.phpへリダイレクト
    header('Location: user_list.php');
  
  }
  ?>