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


function loginCheck(){
if(!isset($_SESSION["chk_ssid"])||$_SESSION["chk_ssid"]!=session_id()){
  echo "Login error";
  exit();
} else{
  session_regenerate_id(true);
  $_SESSION["chk_ssid"] = session_id();
}}
