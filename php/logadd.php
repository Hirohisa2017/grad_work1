<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/main.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<title>新規ユーザー登録</title>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="select.php">新規ユーザー登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="logadd_act.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ブックマークアプリログイン</legend>
    <label>お名前：<input type="text" name="name"></label><br>
     <label>ID：<input type="text" name="lid"></label><br>
     <label>PW：<input type="text" name="lpw"></label><br>
     <label>管理権限タイプ：<input type="text" name="kanri_flg"></label><br>
     <label>入社退社区分：<input type="text" name="life_flg"></label><br>

     <input type="submit" value="ユーザー登録">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->
</body>
</html>