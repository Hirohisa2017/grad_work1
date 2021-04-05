<?php
session_start();
// $id = $_SESSION["id"];
$alumni_name= $_SESSION["alumni_name"];

foreach($alumni_name as $value){
    echo "お名前は$valueです";
};

?>