<?php
session_start();
$preference = $_POST[preference];

foreach($preference as $value){
  echo '検索キーワード：'.$value."\n";
}

// var_dump($preference[0]);

require_once('funcs.php');

//1. 接続します
$pdo = db_conn();

//２．データ登録SQL作成
// $sql = "SELECT * FROM gs_almuni_table WHERE keywords LIKE '%$value%'";
$sql="SELECT * FROM gs_user_table WHERE alumni_flag=1 and keywords LIKE '%$value%'";
$stmt = $pdo->prepare($sql);
$res = $stmt->execute();


//SQL実行時にエラーがある場合
$view="";
if($res==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
} else {
  while($val = $stmt->fetch(PDO::FETCH_ASSOC)){
      // $_SESSION["chk_ssid"]  = session_id();
      // $_SESSION["alumni_name"] = $val['alumni_name'];
      // echo $_SESSION["chk_ssid"];
      //select.phpへ遷移
      // header("Location: select.php");

      $view .="<p>";
      $view .=$val["id"].':'.$val["name"];
      $view .="<a href='./mini_bbs/index.php?id=";
      $view .=$val["id"];    
      $view .= "'>";
      $view .="メッセージを送る </a>";
      $view .="</p>";
    //実験hiddenでpostする実験
      // $view .="<p>";
      // $view .=$val["id"].':'.$val["alumni_name"];
      // $view .="<a href='' onclick='document.form1.submit();return false;>";
      // $view .="ダイレクトメッセージを送る";
      // $view .="</a>";
      // $view .="<form name='form1' method='POST' action='./mini_bbs/index.php'>";
      // $view .="<input type='hidden' name='id' value='";
      // $view .=$val['id'];
      // $view .="'>";
      // $view .="</form>";
      // $view .="</p>";
    }
    };

    echo $view;


//３．抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
// $val = $stmt->fetch(); //1レコードだけ取得する方法

//４. 該当レコードがあればSESSIONに値を代入

//処理終了
exit();
?>