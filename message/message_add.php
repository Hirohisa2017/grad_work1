<?php
session_start();
require_once('funcs.php');

$message_text=$_POST['text'];
$user_id=$_SESSION['id'];
$destination_user_id = $_POST['destination_user_id'];

try{
    $pdo = new PDO('mysql:dbname=honuturtle_gs_db;host=mysql1033.db.sakura.ne.jp;charset=utf8','honuturtle','gs_db_dev18');
} catch (PDOException $e){
    
    exit('DBConnectError:'.$e->getMessage());
}

$stmt = $pdo ->prepare("INSERT INTO message(id, text, user_id, destination_id, created) VALUES (NULL,?,?,?,NOW())");

$stmt->bindValue(1, $message_text, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(2, $user_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(3, $destination_user_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt -> execute();

if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMessage:".$error[2]);
  }else{
    // //５．index.phpへリダイレクト
    // if(!check_relation_message($user_id,$destination_user_id)){
    //     insert_message($user_id,$destination_user_id);}

    // set_flash('sucsess','メッセージを送信しました');
    header('Location:message.php?id='.$destination_user_id.'');
  
  };

?>

//try
//{
// $date = new DateTime();
// $date->setTimeZone(new DateTimeZone('Asia/Tokyo'));

// $message_text=$_POST['text'];
// $user_id=$_SESSION['id'];
// $destination_user_id = $_POST['destination_user_id'];

    //if($message_text=='')
    //{
        //set_flash('danger','メッセージ内容が未記入です');
        //reload();
    //}


// $message_text=htmlspecialchars($message_text,ENT_QUOTES,'UTF-8');
// $user_id=htmlspecialchars($user_id,ENT_QUOTES,'UTF-8');

// $dsn = 'mysql:dbname=honuturtle_gs_db;host=mysql1033.db.sakura.ne.jp;charset=utf8';

// $dbh = new PDO('mysql:dbname=honuturtle_gs_db;host=mysql1033.db.sakura.ne.jp;charset=utf8','honuturtle','gs_db_dev18');
// $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// // $sql = 'INSERT INTO message(id, text, user_id, destination_id, created) VALUES (NULL,?,?,?,sysdate())';
// $stmt = $dbh -> prepare('INSERT INTO message(id, text, user_id, destination_id, created) VALUES (NULL,?,?,?,sysdate())');
// $stmt->bindValue(1, $message_text, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(2, $user_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(3, $destination_user_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

// $stmt -> execute();

// $dbh = null;

// if(!check_relation_message($user_id,$destination_user_id)){
// insert_message($user_id,$destination_user_id);
// }


// }   
// catch (Exception $e)
// {
// print'ただいま障害により大変ご迷惑をお掛けしております。';
// exit();
// }

<!-- <a href="post_index.php">戻る</a> -->