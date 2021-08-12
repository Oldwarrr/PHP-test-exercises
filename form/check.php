<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    // echo $name, "<br>",  $surname, "<br>", $email, "<br>", $message, "<br>";

    //Проверки

    // Чистка
    function clean($value = ""){
        $value = trim($value); // пробелы
        $value = stripslashes($value); // экранированные символы ( \ )
        $value = strip_tags($value); // HTML и PHP теги
        $value = htmlspecialchars($value); // специальные символы HTML
        return $value; // - возвращает очищенную переменную в значение функциии
    }

    //Проверка длины
    function check_length($value = "", $min, $max){
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
        return !$result;
    }
    /* Проверяем $value, который по умолчанию пуст. Если переменная меньше
    мин значения или больше макс значения, то значение переменной не возвращать */


    // СТАРТ!!

    // Чистим с помощью clean
    $name = clean($name);
    $surname = clean($surname);
    $email = clean($email);
    $message = clean($message);

    
    if(!empty($name) && !empty($surname) && !empty($email) && !empty($message)){ // Проверка на пустые поля
        $email_validate = filter_var($email, FILTER_VALIDATE_EMAIL); // функция валидации email
        // filter_validate_email фильтрует имейл
        if(check_length($name,2,20) && check_length($surname,2,30)){ // Проверка длины имени и фамилии
            if($email_validate){ // Проверка валидации
                if(check_length($message,2,300)){ // Проверка длины сообщения
                    echo "Спасибо за сообщение";
                }else{
                    echo "Мин. количество символов сообщения - 2" . "<br>" . "Макс. количество символов сообщения - 300";
                }
                    
            }else{
                echo "Некорректный формат E-mail";
            }
        }else{
            echo "Некорректная длина имени или фамилии";
        }
    }else{
        echo "Заполните пустые поля";
    }
}