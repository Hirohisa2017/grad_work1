

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

<form class="form-signin" action='login_check.php' method='post'>
  <label for="email" class="sr-only">Login ID</label>
  <input type="text" id="email" value=""  name='email' class="form-control" required autofocus>

<!-- password -->
  <label for="password" class="sr-only">Login Password</label>
  <input type="password" id="password" class="form-control" placeholder="Password" name="password" value="" required>
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
