<?php
session_start();
require('../db_connect.php');

if(!empty($_POST)){
	if($_POST['name']===''){
		$error['name']='blank';
	};

	if($_POST['email']===''){
		$error['email']='blank';
	};

	if(strlen($_POST['password'])<4){
		$error['password']='length';
	};


	if($_POST['password']===''){
		$error['password']='blank';
	};

	$fileName = $_FILES['image']['name'];
	if(!empty($fileName)){
		$ext = substr($fileName, -3);
		if($ext !="jpg" && $ext !="gif" && $ext !="png"){
			$error['image'] = 'type';
		}
	}
	//アカウント重複チェック
	if(!empty($error)){
		$member=$db->prepare('SELECT COUNT(*) AS cnt FROM gs_user_table WHERE email=?');
		$member->execute(array($_POST['email'])); 
		$record = $member ->fetch();
		if($record['cnt']>0){
			$error['email']='duplicate';
		}
	}

	if(empty($error)){
		$image=date('YmdHis') . $_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'],'../member_picture/'. $image);
		$_SESSION['join'] = $_POST;
		$_SESSION['join']['image']=$image;
		header('Location:check.php');
		exit();
	}
}

if($_REQUEST['action']=='rewrite' && isset($_SESSION['join'])){
	$_POST=$SESSION['join'];
}
?>


<!doctype html>
<html lang="ja" >
  <head>
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="../signin.css" rel="stylesheet">
  </head>
  <body  class="text-center" >
    <a id="skippy" class="sr-only sr-only-focusable" href="#content">
  <div class="container">
    <span class="skiplink-text">Skip to main content</span>
  </div>
</a>

<form class="form-signin" action='' method='post'  enctype="multipart/form-data">
  <h1 class="h3 mb-3 font-weight-normal">Register</h1>
	<!-- name -->
	<label for="inputName" class="sr-only">Name</label>
	<input type="text" name="name" value="<?php print(htmlspecialchars($_POST['name'], ENT_QUOTES)); ?>" placeholder='name' class='form-control' required autofocus/>
	<?php if($error['name']==='blank'): ?>
	<p class='error'>ニックネームを入力してください</p>
	<?php endif; ?>

	<!-- email -->
	<label for="inputEmail" class="sr-only">Email address</label>
	<input name="email" type="email" id="inputEmail" value="<?php print(htmlspecialchars($_POST['email'], ENT_QUOTES)); ?>"  class="form-control" placeholder="Email address" required>
	<?php if($error['email']==='blank'):?> 
	<p class='error'> メールアドレスを入力してください</p>
	<?php endif; ?>
	<?php if($error['email']==='duplicate'):?> 
	<p class='error'> 指定されたメールアドレスはすでに登録されています。</p>
	<?php endif; ?>

	<!-- password -->
	<label for="inputPassword" class="sr-only">Password(4文字以上)</label>
  	<input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>" required>
	<?php if($error['password']==='blank'):?> 
	<p class='error'>パスワードを入力してください</p>
	<?php endif; ?>
	<?php if($error['password']==='length'):?> 
	<p class='error'>パスワードを４文字以上に設定してください</p>
	<?php endif; ?>

	<!-- picture -->
	<label for="inputPicture" class="sr-only">Picture</label>
  	<input type="file" id="inputPicture" class="form-control"name="image" value="test">
	<?php if($error['image']==='type'):?> 
	<p class='error'>画像ファイルを保存してください</p>
	<?php endif; ?>	
	<?php if(!empty($error)): ?>
	<p class='error'>画像をもう一度保存してください</p>
	<?php endif; ?>

  <button class="btn btn-lg btn-primary btn-block" type="submit">Confirm</button>

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