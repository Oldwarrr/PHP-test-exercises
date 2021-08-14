<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $tel = $_POST['tel'];
    $message = $_POST['message'];
    $choice = $_POST['choice'];
}
foreach($_POST as $name => $field){
    $arFields[$field] = htmlspecialchars(stripslashes(strip_tags((trim($field)))));
    echo "$name : $field" . "<br>" . "<hr>";
    $fopen = fopen('text.txt', 'a+');
    $fwrite = fwrite($fopen, "$name : $field \n");
    $fclose = fclose($fopen);
    
}


