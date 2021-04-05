<?php
session_start();
$name = $_POST['name'];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

require_once('funcs.php');

//1. 接続します
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "INSERT INTO gs_user_table(id, name, lid, lpw) VALUES (null,:name, :lid, :lpw)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw,  PDO::PARAM_STR);
$res = $stmt->execute();

//SQL実行時にエラーがある場合
if($res==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
} else{
    //login.phpへリダイレクト
    header('Location: select.php');
  }
  ?>