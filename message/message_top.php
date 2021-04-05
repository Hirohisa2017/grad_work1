<?php
$current_user = get_user($_SESSION['user_id']);
$message_relations = get_message_relations($current_user['id']);
foreach ($message_relations as $message_relation) :
if($message_relation['destination_user_id']==$current_user['id']){
$destination_user=get_user($message_relation['user_id']);
}else{
$destination_user=get_user($message_relation['destination_user_id']);
}
$bottom_message=get_bottom_message($current_user['id'],$destination_user['id']);
?>

<body>
    <div class="row">
    <div class="col-8 offset-2">
<a href='message.php?user_id=<?= $destination_user['id'] ?>'>
    <div class="destination_user_list">
    <img src="../user/image/<?= $destination_user['image']?>" class="message_user_img">
<div class='destination_user_info'>
        <div class="destination_user_name"><?= $destination_user['name']?></div>
        <span class="destination_user_text"><?= $bottom_message['text'] ?></span>
        </div>
        <span class="bottom_message_time"><?= convert_to_fuzzy_time($bottom_message['created_at']); ?></span>
    </div>
    </a>
</div>
</div>
<?php endforeach ?>
</body>