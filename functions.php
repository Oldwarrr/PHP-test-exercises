<?php

function debug($data){
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

function load($data){
    foreach($_POST as $k => $v){
        if(array_key_exists($k, $data)){
            $data[$k]['value'] = trim(strip_tags(stripcslashes(htmlspecialchars($v))));
        }
    }
    return $data;
}

function validate($data){
    $errors = '';
    foreach($data as $k => $v){
        if($data[$k]['required'] && empty($data[$k]['value'])){
            $errors .= "<li style='font-size:20px; width: 300px; word-wrap: break-word'>Вы не заполнили поле {$data[$k]['field_name']}</li>";
        }
    }
    if(!check_captcha($data['captcha']['value'])){
        $errors .= "<li style='font-size:20px'>Неверно заполнено поле Captcha</li>";
    }
    return $errors;
}

function set_captcha(){
    $num1 = rand(1,10);
    $num2 = rand(1,10);
    $_SESSION['captcha'] = $num1 + $num2;
    return "Сколько будет {$num1} + {$num2}?";
}

function check_captcha($res){
    return $_SESSION['captcha'] == $res;
}



function write($data){
    foreach($data as $k => $v){
        if($k !== 'agree' && $k !== "captcha"){      
            $info = $v['field_name'] . " : " . $v['value'] ; 
            $fopen = fopen('data.txt', 'a+');
            $write = fwrite($fopen, "$info \n");
            $fclose = fclose($fopen);    
        }
    }
    $fopen = fopen('data.txt', 'a+');
    $write = fwrite($fopen, "\n");
    return $fclose = fclose($fopen);   
}

function data(){
    $data = file_get_contents('data.txt');
    return $data;
}

function uploadImage($image){
    $name = $image['name'];
    $name = 'avatar.jpg';
    $tmp_name = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp_name, "uploads/" . $name);
}
