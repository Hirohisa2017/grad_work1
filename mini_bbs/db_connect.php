<?php
try{
    $db=new PDO('mysql:dbname=honuturtle_gs_db;charset=utf8;host=mysql1033.db.sakura.ne.jp','honuturtle','gs_db_dev18');
} catch(PDOException $e){
    print('DB接続エラー：' . $e->getMessage());
}

?>