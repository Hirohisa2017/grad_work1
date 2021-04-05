<?php
session_start();
require('db_connect.php');

if($_COOKIE['email'] != ''){
  $email = $_COOKIE['email'];
}

if(!empty($_POST)){
  $email=$_POST['email'];

  if($_POST['email'] !=='' && $_POST['password'] !==''){
    $login = $db->prepare('SELECT * FROM gs_user_table WHERE email=? AND password=?');
    $login->execute(array(
      $_POST['email'],
      $_POST['password']
    ));
    $member=$login->fetch();
    if($member){
      $_SESSION['id'] = $member['id'];
      $_SESSION['time'] = time();

      if($_POST['save']==='on'){
        setcookie('email', $_POST['email'],time()+60*60*24*7);
      }

      header('Location: ../select.php');
      exit();
    } else {
      $error['login'] = 'failed'; 
    }
  } else {
    $error['login'] = 'blank';
  }
}

?>

<!doctype html>
<html lang="ja" >
  <head>
    <title>Signin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="signin.css" rel="stylesheet">
  </head>
  <body  class="text-center" >
    <a id="skippy" class="sr-only sr-only-focusable" href="#content">
  <div class="container">
    <span class="skiplink-text">Skip to main content</span>
  </div>
</a>

<form class="form-signin" action='' method='post'>
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  <!-- email -->
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" value="<?php echo htmlspecialchars($email, ENT_QUOTES); ?>"  name='email' class="form-control" placeholder="Email address" required autofocus>
  <?php if($error['login']==='blank'): ?>
          <p class='error'>メールアドレスとパスワードを入力してください</p>
          <?php  endif; ?>

          <?php if($error['login']==='failed'): ?>
          <p class='error'>メールアドレスとパスワードを正しく入力してください</p>
          <?php  endif; ?>    
<!-- password -->
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>" required>
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

</form>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script><script src="/docs/4.3/assets/js/vendor/anchor.min.js"></script>
    <script src="/docs/4.3/assets/js/vendor/clipboard.min.js"></script>
    <script src="/docs/4.3/assets/js/vendor/bs-custom-file-input.min.js"></script>
    <script src="/docs/4.3/assets/js/src/application.js"></script>
    <script src="/docs/4.3/assets/js/src/search.js"></script>
    <script src="/docs/4.3/assets/js/src/ie-emulation-modes-warning.js"></script>
  </body>
</html>
