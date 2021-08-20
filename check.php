<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $tel = $_POST['tel'];
    $message = $_POST['message'];
    $choice = $_POST['choice'];
}



function check_length($value, $min, $max){ // Функция на проверку длины
    $result = mb_strlen($value) < $min || mb_strlen($value) > $max;
    return !$result;
}
if(!empty($tel) && !empty($message) && !empty($choice)){ // Заполненность полей

    if(check_length($message, 5, 200)){ // Длина сообщения

        foreach($_POST as $name => $field){ // Перебор элементов с выводом на экран
            $arFields[$field] = htmlspecialchars(stripslashes(strip_tags((trim($field))))); // Очистка
            echo "$name : $field" . "<br>" . "<hr>";
            $fopen = fopen('data.txt', 'a+'); // Запись данных в файл
            $fwrite = fwrite($fopen, "$name : $field \n");
             $fclose = fclose($fopen);    
        }
    }else{
        echo "Слишком короткое сообщение";
    }
  }else{
      echo "Заполните все поля формы <br/>";
  }


  if(isset($_POST['click'])){
    $fread = fopen("data.txt", "r");
    $contents = fread($fread, filesize("data.txt"));
    fclose($fread);
    echo $contents;
}

