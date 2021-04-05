<?php
// session_start();

echo '<p>好きな色: ';
foreach( $_POST[preference] as $value ){
    echo "{$value}, ";
}
echo '</p>';
?>