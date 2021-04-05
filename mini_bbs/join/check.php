<?php
session_start();
require ('../db_connect.php');


if(!isset($_SESSION['join'])){
	header('Location:index.php');
	exit();
}
if(!empty($_POST)){
$statement = $db -> prepare('INSERT INTO gs_user_table SET name=?, email=?, password=?, picture=?, created=NOW()');
$statement -> execute(array(
	$_SESSION['join']['name'],
	$_SESSION['join']['email'],
	$_SESSION['join']['password'],
	$_SESSION['join']['image']
));
	unset($_SESSION['join']);
	header('Location: thanks.php');
	exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Register - Confirmation</title>

	<link rel="stylesheet" href="../style.css" />
</head>
<body>
<div id="wrap">
<div id="head">
<h1>Register</h1>
</div>

<div id="content">
<p>内容を確認の上、「登録する」を押してください</p>
<form action="" method="post">
	<input type="hidden" name="action" value="submit" />
	<dl>
		<dt>Name</dt>
		<dd>
		<?php print(htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES)); ?>
        </dd>
		<dt>Email</dt>
		<dd>
		<?php print(htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES)); ?>
        </dd>
		<dt>Password</dt>
		<dd>
		【表示されません】
		</dd>
		<dt>Picture</dt>
		<?php if($_SESSION['join']['image'] !== ""): ?>
			<img src="../member_picture/<?php print(htmlspecialchars($_SESSION['join']['image'], ENT_QUOTES)); ?>" alt="" style='max-width:100%'>;
		<?php endif; ?>
		<dd>
		</dd>
	</dl>
	<div><a href="index.php?action=rewrite">&laquo;&nbsp;戻る</a> | <input class="btn btn-lg btn-primary btn-block" type="submit" value="登録する" /></div>
</form>
</div>

</div>
</body>
</html>
