<?php
session_start();

$meeting_time = $_POST['meeting_time'];
var_dump($meeting_time);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ショッピングカート</title>
</head>
<body>
下記の内容で確定します。よろしいですか？

<?php print($date). "\n";?>
<?php print($time);?>
<form action="../zoom/index.php" post='post'>
<button type='hidden' name='meeting_time' value='<?php $meeting_time ?>'>確定</button>
</form>
</body>
</html>