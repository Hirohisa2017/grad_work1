<?php
session_start();
require_once('funcs.php');

$id=$_SESSION['id'];
$name = $_SESSION['name'];

$current_user = get_user($_SESSION['id']);
$destination_user = get_user($_GET['id']);

// var_dump($current_user['id']);

function get_messages($user_id,$destination_user_id){
    try {
      $dsn='mysql:dbname=honuturtle_gs_db;host=mysql1033.db.sakura.ne.jp;charset=utf8';
      $user='honuturtle';
      $password='gs_db_dev18';
      $dbh=new PDO($dsn,$user,$password);
      $sql = "SELECT *
              FROM message
              WHERE (user_id = :id and destination_id = :destination_user_id) or (user_id = :destination_user_id and destination_id = :id)
              ORDER BY created ASC";
      $stmt = $dbh->prepare($sql);
      $stmt->execute(array(':id' => $user_id,
                           ':destination_user_id' => $destination_user_id));
      return $stmt->fetchAll();
    } catch (\Exception $e) {
      error_log('エラー発生:' . $e->getMessage());
      set_flash('error',ERR_MSG1);
    }
  }

$messages = get_messages($current_user['id'], $destination_user['id']);

// var_dump($messages['user_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
/* 左側コメントのスタイル */
.says {
  position: relative;
  display: inline-block;
  margin: 1.5em 0 1.5em 15px;
  padding: 7px 10px;
  min-width: 120px;
  max-width: 100%;
  color: #555;
  font-size: 16px;
  background: #e0edff;
}

.says:before {
  content: "";
  position: absolute;
  top: 50%;
  left: -30px;
  margin-top: -15px;
  border: 15px solid transparent;
  border-right: 15px solid #e0edff;
}
/* 右側のスタイル＝私 */
.right {
  position: relative;
  display: inline-block;
  margin: 1.5em 15px 1.5em 0;
  padding: 7px 10px;
  min-width: 120px;
  max-width: 100%;
  color: #555;
  font-size: 16px;
  background: #e0edff;
}

.right:before {
  content: "";
  position: absolute;
  top: 50%;
  left: 100%;
  margin-top: -15px;
  border: 15px solid transparent;
  border-left: 15px solid #e0edff;
}

</style>

<body>
　<div class="message">
    <h2 class="center"><?= $destination_user['name'] ?>さんとのダイレクトメッセージ</h2>
    <!-- メッセージ表示フォーム -->
    <?php foreach ($messages as $message):?>
        <div class="my_message">
        <?php if ($message['user_id'] == $current_user['id']) : ?>
            <div class="right"><?= $message['text'] ?></div><span>わたし</span>
        <?php else : ?>
            <div><?= $destination_user['name'] ?>さん
            <div class="says"><?= $message['text'] ?></div>
            <?php endif; ?>
            </div>
    <?php endforeach; ?>

    <!-- メッセージ送信フォーム -->
    <div class="message_process">
    　<h2 class="message_title">メッセージ</h2>
    　<form method="post" action="message_add.php" >
        <textarea class="textarea form-control" placeholder="メッセージを入力ください" name="text"></textarea>
        <input type="hidden" name="destination_user_id" value="<?= $destination_user['id'] ?>">
        <div class="message_btn">
            <!-- <div class="message_image">
                <input type="file" name="image" class="my_image" accept="image/*" multiple>
            </div> -->
            <button class="btn btn-outline-primary" type="submit" name="post" value="post" id="post">投稿</button>
        </div>
    　</form>
    </div>
    <!-- 面接日程オファー -->
    <div class="message_process">
    　<h2 class="message_title">面接日程を決める(３０日先まで設定可能)</h2>
    　<form method="post" action="../payment/payment.php" >
      <label for="date">日付</label>
      <input type="date" value="<?php echo date('Y-m-d'); ?>"  name="date" id="date">
      <label for="time">時間</label>
      <input type="time" value="<?php echo date('H:i:s'); ?>"  name="time" id="time">
        <div class="message_btn">
            <button class="btn btn-outline-primary" type="submit" name="post" value="post" id="post">面接をオファーする 
            </button>
        </div>
    　</form>
    </div>

　</div>

</body>
</html>
