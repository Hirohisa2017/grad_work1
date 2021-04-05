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
$stmt = $pdo->prepare("UPDATE `gs_user_table` SET `id`=:id,`name`=:name,`lid`=:lid,`lpw`=:lpw,`kanri_flg`=:kanri_flg,`life_flg`=:life_flg WHERE id=:id");

$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg',$kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);


//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:".$error[2]);
  
}
else{
  //５．user_list.phpへリダイレクト
  header('Location: user_list.php');

}
?>