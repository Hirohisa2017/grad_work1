<?php
session_start();

require_once('funcs.php');

//1. 接続します
$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .="<p>";
    $view .='<a href="message.php?id='.$result["id"].'">';
    $view .=$result["id"].':'.$result["name"];
    $view .='</a>';
    $view .="</p>";

  }
  print($view);
}
?>