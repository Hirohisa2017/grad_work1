<?php
session_start();
$email = $_POST["email"];
$password = $_POST["password"];

require_once('funcs.php');

//1. 接続します
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_user_table WHERE email=:email AND password=:password";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password,  PDO::PARAM_STR);
$res = $stmt->execute();

//SQL実行時にエラーがある場合
if($res==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

//３．抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //1レコードだけ取得する方法

//４. 該当レコードがあればSESSIONに値を代入
if( $val["id"] != "" ){
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION['id'] = $val['id'];
  $_SESSION["email"] =$val['email'];
  $_SESSION["name"]       = $val['name'];
  //Login処理OKの場合select.phpへ遷移
  header("Location: user_list.php");
}else{
  //Login処理NGの場合login.phpへ遷移
  header("Location: login.php");
}
//処理終了
exit();
?>