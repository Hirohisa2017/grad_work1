<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}


function db_conn(){
    try {
        //ID:'root', Password: 'root'
        $pdo = new PDO('mysql:dbname=honuturtle_gs_db;charset=utf8;host=mysql1033.db.sakura.ne.jp','honuturtle','gs_db_dev18');
        return $pdo;
      } catch (PDOException $e) {
        exit('DBConnectError:'.$e->getMessage());
      }
};

function moveTo(){
  header('Location: ../payment/payment.php');
  exit();
}


function offer_response(){
  $message_text=$_POST['text'];
  $user_id=$_SESSION['id'];
  $destination_user_id = $_POST['destination_user_id'];

  $answer .="<form method='post'>";
  $answer .="<input type='button' id='yes' name='yes' value='yes'>";
  $answer .="<input type='button' id='no' name='no' value='no'>";
  $answer .="</form>";


  try{
          $pdo = new PDO('mysql:dbname=honuturtle_gs_db;host=mysql1033.db.sakura.ne.jp;charset=utf8','honuturtle','gs_db_dev18');
      } catch (PDOException $e){
          
          exit('DBConnectError:'.$e->getMessage());
      }

      $stmt = $pdo ->prepare("INSERT INTO message(id, text, user_id, destination_id, created) VALUES (NULL,?,?,?,DATE_ADD(NOW(), INTERVAL 20 SECOND))");

      $stmt->bindValue(1, $answer, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(2, $destination_user_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(3, $user_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

      $status = $stmt -> execute();

  if(isset($_POST['yes'])) {
    moveTo();
  } 

};



function loginCheck(){
if(!isset($_SESSION["chk_ssid"])||$_SESSION["chk_ssid"]!=session_id()){
  echo "Login error";
  exit();
} else{
  session_regenerate_id(true);
  $_SESSION["chk_ssid"] = session_id();
}}

//Homepageから持ってきたコード

function get_user($id){
  try {
    $dsn='mysql:dbname=honuturtle_gs_db;host=mysql1033.db.sakura.ne.jp;charset=utf8';

    $dbh= new PDO($dsn,'honuturtle','gs_db_dev18');
    $sql = "SELECT id, name, email FROM gs_user_table WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(':id' => $id));
    return $stmt->fetch();
  } catch (\Exception $e) {
    error_log('エラー発生:' . $e->getMessage());
    set_flash('error',ERR_MSG1);
  }
}

// function get_messages($id,$destination_id){
//   try {
//     $dsn='mysql:dbname=honuturtle_gs_db;host=mysql1033.db.sakura.ne.jp;charset=utf8';
//     $user='root';
//     $password='root';
//     $dbh=new PDO($dsn,$user,$password);
//     $sql = "SELECT *
//             FROM message
//             WHERE (user_id = :id and destination_id = :destination_id) or (user_id = :destination_id and destination_id = :id)
//             ORDER BY created ASC";
//     $stmt = $dbh->prepare($sql);
//     $stmt->execute(array(':id' => $id,
//                          ':destination_id' => $destination_id));
//     return $stmt->fetchAll();
//   } catch (PDOException $e){    
//     exit('DBConnectError:'.$e->getMessage());
// }
// }


// function get_messages($id,$destination_user_id){
//       try{
//         $pdo = new PDO('mysql:dbname=honuturtle_gs_db;host=mysql1033.db.sakura.ne.jp;charset=utf8','honuturtle','gs_db_dev18');
//     } catch (PDOException $e){ 
//         exit('DBConnectError:'.$e->getMessage());
//     }

//     $stmt = $pdo -> prepare("SELECT * FROM message WHERE (user_id=? and destination_id =?) OR (user_id=? and destination_id=?) ORDER BY created ASC");

//     $stmt->bindValue(1, $id, PDO::PARAM_INR);  //Integer（数値の場合 PDO::PARAM_INT)
//     $stmt->bindValue(2, $destination_user_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
//     $stmt->bindValue(3, $destination_user_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
//     $stmt->bindValue(4, $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

//     $status = $stmt -> execute();
//     return $stmt->fetch();
//   }



// function check_relation_message($id,$destination_user_id){
//   try {
//     $dsn='mysql:dbname=honuturtle_gs_db;host=mysql1033.db.sakura.ne.jp;charset=utf8';
//     $dbh=new PDO($dsn,'honuturtle','gs_db_dev18');
//     $sql = "SELECT user_id,destination_user_id
//             FROM message_relation
//             WHERE (user_id = :user_id and destination_user_id = :destination_user_id)
//                   or (user_id = :destination_user_id and destination_user_id = :user_id)";
//     $stmt = $dbh->prepare($sql);
//     $stmt->execute(array(':user_id' => $id,
//                          ':destination_user_id' => $destination_user_id));
//     return $stmt->fetch();
//   } catch (\Exception $e) {
//     error_log('エラー発生:' . $e->getMessage());
//     set_flash('error',ERR_MSG1);
//   }
// }
