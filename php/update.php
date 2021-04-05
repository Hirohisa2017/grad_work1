<?php

require_once('funcs.php');

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
$stmt = $pdo->prepare("UPDATE `gs_bm_table` SET `id`=:id,`書籍名`=:bookTitle,`書籍URL`=:bookUrl,`書籍コメント`=:bookComment,`登録日時`=sysdate() WHERE id=:id");

$stmt->bindValue(':bookTitle', $bookTitle, PDO::PARAM_STR);
$stmt->bindValue(':bookUrl', $bookUrl, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':bookComment',$bookComment, PDO::PARAM_STR);

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