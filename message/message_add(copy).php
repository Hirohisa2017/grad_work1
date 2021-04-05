<?php
session_start();
require_once('funcs.php');

try
{
// $date = new DateTime();
// $date->setTimeZone(new DateTimeZone('Asia/Tokyo'));

$message_text=$_POST['text'];
$id=$_SESSION['id'];
$destination_user_id = $_POST['destination_user_id'];

    if($message_text=='')
    {
        set_flash('danger','メッセージ内容が未記入です');
        reload();
    }


$message_text=htmlspecialchars($message_text,ENT_QUOTES,'UTF-8');
$id=htmlspecialchars($id,ENT_QUOTES,'UTF-8');

$dsn = 'mysql:dbname=honuturtle_gs_db;host=mysql1033.db.sakura.ne.jp;charset=utf8';

$dbh = new PDO($dsn,'honuturtle','gs_db_dev18');
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'INSERT INTO message(id, text, user_id, destination_id, created) VALUES (null,:message_text, :user_id, :destination_id, now())';
$stmt = $dbh -> prepare($sql);
$stmt->bindValue(':message_text', $message_text, PDO::PARAM_STR);
$stmt->bindValue(':user_id', $id, PDO::PARAM_STR);
$stmt->bindValue(':destination_id', $destination_id,  PDO::PARAM_STR);

$res= $stmt -> execute();

if($res==false){
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);} 
    
    $dbh = null;

if(!check_relation_message($id,$destination_user_id)){
insert_message($id,$destination_user_id);
}
set_flash('sucsess','メッセージを送信しました');
header('Location:message.php?user_id='.$destination_user_id.'');

}   
catch (Exception $e)
{
print'ただいま障害により大変ご迷惑をお掛けしております。';
exit();
}

?>

<a href="post_index.php">戻る</a>