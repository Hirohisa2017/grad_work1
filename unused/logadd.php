<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/main.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<title>Sign up</title>
</head>
<body>

<!-- Head[Start] -->
<!-- <header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="select.php">新規ユーザー登録</a>
      </div>
    </div>
  </nav>
</header> -->
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="logadd_act.php" enctype="multipart/form-data">
  <div class="jumbotron">
   <fieldset>
    <legend>Sign up</legend>
    <label>お名前：<input type="text" name="name"></label><br>
     <label>ID：<input type="text" name="lid"></label><br>
     <label>PW：<input type="text" name="lpw"></label><br>
     <input type="file" name="image">
     </br>
     <input type="submit" value="Register">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->
</body>
</html>