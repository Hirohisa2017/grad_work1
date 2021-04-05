<?php
session_start();
require('db_connect.php');


if(isset($_SESSION['id']) && $_SESSION['time']+3600>time()){
  $_SESSION['time'] = time();
	$members= $db->prepare('SELECT * FROM gs_user_table WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members ->fetch();
} else {
	header('Location:login.php');
	exit();
}

$id = $_GET['id']; ;
//アルムナイidを引っ張ってくる
if(isset($_GET['id'])) { 
  $id = $_GET['id']; 
  $stm = $db->prepare("SELECT alumni_name FROM gs_almuni_table WHERE id=:id");
  $stm->bindValue(':id', $id, PDO::PARAM_INT);
  $stm->execute();
  $ids=$stm->fetch();
  // print($ids['alumni_name']);
}
//メッセージ登録処理
if(!empty($_POST)){
  if($_POST['message'] !== ''){
    // $id = $_GET['id']; 
    $message = $db->prepare('INSERT INTO posts SET member_id=?, message=?, reply_message_id=?, created= NOW()');
    $message->execute(array(
      $member['id'],
      $_POST['message'],
      $_POST['reply_post_id']
    ));
    // header('Location: index.php');
  }
}
//ここは実験部分
$ses_id=$_SESSION['id'];
$posts = $db->query('SELECT m.name, m.picture, p.* FROM gs_user_table m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC');


// 返信の処理
// if(isset($_REQUEST['res'])){
//       $response= $db->prepare('SELECT m.name, m.picture, p.* FROM gs_user_table m, posts p WHERE m.id=p.member_id AND p.id=?');
//       $response->execute(array($_REQUEST['res']));
//       $table=$response->fetch();
//       $message='@' . $table['name'] . '' . $table['message'];

// }

?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>メッセージ</title>

	<link rel="stylesheet" href="style.css" />
</head>

<body>
<div id="wrap">
  <div id="head">
    <h1>ダイレクトメッセージ</h1>
  </div>
  <div id="content">
  	<div style="text-align: right"><a href="logout.php">ログアウト</a></div>
    <form action="index.php?id=<?php print(htmlspecialchars($_GET['id'])); ?>" method="post">
      <dl>
        <dt><?php print(htmlspecialchars($member['name'], ENT_QUOTES)) ?>さん、メッセージをどうぞ</dt>
        <dd>
          <textarea name="message" cols="50" rows="5"><?php print(htmlspecialchars($message, ENT_QUOTES)); ?></textarea>
          <!-- <div>面談希望日：<input type="date" min="today()" max="2021-08-31"></input> -->
          </div>
          <input type="hidden" name="reply_post_id" value="<?php print(htmlspecialchars($_REQUEST['res'], ENT_QUOTES)); ?>" />
        </dd>
      </dl>
      <div>
        <p>
            <!-- <input type="submit" value="メッセージを送る" /> -->
            <button type='submit'>送信</button>
        </p>
      </div>
    </form>

      <?php foreach($posts as $post): ?>
        <?php if($_SESSION['id']==$post['member_id'] || $post['member_id']==$_GET['id'] )  :?>
          <div class="msg">
          <img src="member_picture/<?php print(htmlspecialchars($member['picture'], ENT_QUOTES)) ?>" width="48" height="48" alt="<?php print(htmlspecialchars($member['name'], ENT_QUOTES)) ?>" />
          <p><?php print(htmlspecialchars($post['message'], ENT_QUOTES)); ?>
          <span class="name">（<?php print(htmlspecialchars($post['name'], ENT_QUOTES)); ?>）</span>

          </p>
            <?php  if($_SESSION['id']==$post['member_id']): ?>
            [<a href="delete.php?id=<?php print(htmlspecialchars($post['id'])); ?>"
            style="color: #F33;">削除</a>]
            <?php endif; ?>
          </p>
          </div>
          <?php endif; ?>
      <?php endforeach; ?>

<ul class="paging">
<li><a href="index.php?page=">前のページへ</a></li>
<li><a href="index.php?page=">次のページへ</a></li>
</ul>
  </div>
</div>
</body>
</html>
