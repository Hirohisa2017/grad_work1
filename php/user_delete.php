<?php

require_once('funcs.php');


//1. POSTデータ取得
$id = $_GET['id'];
$name = $_GET['name'];
$lid = $_GET['lid'];
$lpw = $_GET['lpw'];
$kanri_flg = $_GET['kanri_flg'];
$life_flg = $_GET['life_flg'];

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成

// 1. SQL文を用意
$stmt = $pdo->prepare("DELETE FROM `gs_user_table` WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);


//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:".$error[2]);
  
}
else{
  //５．index.phpへリダイレクト
  header('Location: user_list.php');

}
?>