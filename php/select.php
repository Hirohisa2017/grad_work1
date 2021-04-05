<?php
session_start();

require_once('funcs.php');

//login認証
loginCheck();


//1.  DB接続します
// try {
//   //ID:'root', Password: 'root'
//   $pdo = new PDO('mysql:dbname=honuturtle_gs_db;charset=utf8;host=mysql1033.db.sakura.ne.jp','honuturtle','gs_db_dev18');
// } catch (PDOException $e) {
//   exit('DBConnectError:'.$e->getMessage());
// }

$pdo = db_conn();

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    //$view .= "<p>".$result['id'].".".$result['書籍名']."/".$result['書籍URL']."/".$result['書籍コメント']."/".$result['登録日時']."</p>";
    $view .="<p>";
    $view .='<a href="u_view.php?id='.$result["id"].'">';
    $view .=$result["登録日時"].':'.$result["書籍名"];
    $view .='</a>';
    $view .="</p>";

    //削除ボタン表示
    if($_SESSION['kanri_flg']==1){
    $view .='<a href="delete.php?id='.$result["id"].'">';
    $view .='消しちゃいます';
    $view .='</a>';

    }
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      <a class="navbar-brand" href="logout.php">ログアウト</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?= $view ?></div>
</div>
<!-- Main[End] -->

</body>
</html>
