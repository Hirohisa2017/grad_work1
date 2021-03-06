<?php
session_start();
/**
 * 1. index.phpのフォームの部分がおかしいので、ここを書き換えて、
 * insert.phpにPOSTでデータが飛ぶようにしてください。
 * 2. insert.phpで値を受け取ってください。
 * 3. 受け取ったデータをバインド変数に与えてください。
 * 4. index.phpフォームに書き込み、送信を行ってみて、実際にPhpMyAdminを確認してみてください！
 */


//1. POSTデータ取得
$bookTitle = $_GET['bookTitle'];
$bookUrl = $_GET['bookUrl'];
$bookComment = $_GET['bookComment'];
$id = $_GET['id'];

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成

// 1. SQL文を用意
$stmt = $pdo->prepare("DELETE FROM `gs_bm_table` WHERE id=:id");
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
  header('Location: index.php');

}
?>