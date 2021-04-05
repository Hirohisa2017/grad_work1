<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="./css/login.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<title>ログイン</title>
</head>
<body>

<!-- Head[Start] -->
<!-- <header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="select.php">ログイン</a>
      </div>
    </div>
  </nav>
</header> -->
<!-- Head[End] -->

<!-- Main[Start] -->
<!-- <form method="post" action="login_act.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ログイン</legend>
     <label>ID：<input type="text" name="lid"></label><br>
     <label>PW：<input type="text" name="lpw"></label><br>
     <input type="submit" value="ログイン">
    </fieldset>
    <p>新規ユーザー登録は<a href="logadd.php">こちら</a></p>
  </div>
</form> -->

<div class="sidenav">
  <div class="login-main-text">
    <h2>Application<br> Login Page</h2>
    <p>Login or register from here to access.</p>
  </div>
</div>
<div class="main">
  <div class="col-md-6 col-sm-12">
    <div class="login-form">
      <form method='post' action='login_act.php'>
        <div class="form-group">
          <label>User name</label>
          <input type="text" class="form-control" placeholder="User Name" name='lid'>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" placeholder="Password" name='lpw'>
        </div>
        <button type="submit" class="btn btn-black">Login</button>
        </form>
        <button type="submit" class="btn btn-secondary"><a href='logadd.php'>Register</button>
      </div>
  </div>
</div>


<!-- Main[End] -->
</body>
</html>