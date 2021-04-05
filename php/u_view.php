<?php

$id = $_GET['id'];

require_once('funcs.php');

//db接続
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id = ' . $id . ';');
$status = $stmt->execute();
//３．データ表示
if ($status == false) {
    sql_error($status);
} else {
    $row = $stmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ブックマークアプリ</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="GET" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>読みたい本リスト</legend>
     <label>書籍名：<input type="text" name="bookTitle" value ="<?= $row['書籍名'] ?>"></label><br>
     <label>書籍URL：<input type="text" name="bookUrl" value ="<?=$row['書籍URL']?>"></label><br>
     <label>書籍コメント：<textArea name="bookComment" rows="4" cols="40"><?=$row['書籍コメント']?></textArea></label><br>
     <input type="hidden" name = 'id' value ="<?= $row['id'] ?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>


