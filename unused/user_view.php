<?php

$id = $_GET['id'];

require_once('funcs.php');

//db接続
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_user_table WHERE id = ' . $id . ';');
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
  <title>ユーザー詳細</title>
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
<form method="GET" action="user_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー詳細</legend>
     <label>お名前：<input type="text" name="name" value ="<?= $row['name'] ?>"></label><br>
     <label>id名：<input type="text" name="lid" value ="<?=$row['lid']?>"></label><br>
     <label>PW：<input type="text" name="lpw" value ="<?=$row['lpw']?>"></label><br>
     <label>管理者権限：<input type="text" name="kanri_flg" value ="<?=$row['kanri_flg']?>"></label><br>
     <label>入社退社管理：<input type="text" name="life_flg" value ="<?=$row['life_flg']?>"></label><br>
     <input type="hidden" name = 'id' value ="<?= $row['id'] ?>">
     <input type="submit" value="更新">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>


