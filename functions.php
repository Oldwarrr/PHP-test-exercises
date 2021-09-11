<?php

function pre($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

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
            $errors .= "<li style='font-size:20px; word-wrap: break-word'>Вы не заполнили поле {$data[$k]['field_name']}</li>";
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
    $dataPack = "";
    foreach($data as $k => $v){
        if($k !== 'agree' && $k !== "captcha"){      
            $dataItem = $v['field_name'] . " : " . $v['value'] . " \n" ;
            
            
               
            $dataPack .= $dataItem; 
            
            
        }
        
    }
    
    $dataPack = serialize($dataPack);
    $fopen = fopen('data/data.txt', 'a+');
            $write = fwrite($fopen, "$dataPack \n");
            $fclose = fclose($fopen); 

    $fopen = fopen('data/data.txt', 'a+');
    $write = fwrite($fopen, "\n");
    return $fclose = fclose($fopen);   

    
}

function data(){
    $output = file_get_contents('data/data.txt'); 
    return $output;
}


function uploadImage($image){
    
        $name = $image['name'];
        $name = 'avatar.jpg';
        $tmp_name = $_FILES['image']['tmp_name'];
  

    move_uploaded_file($tmp_name, "uploads/" . $name);

}

function uploadFileCsv($csv){
        
        $nameFile = $csv['name'];
        $nameFile = 'data.csv';

        $tmp_name = $_FILES['csv']['tmp_name'];
        move_uploaded_file($tmp_name, "uploads/" . $nameFile);
        
  
}

function upload($file,$w,$h){
    // $fileName = $file['name'];
    // $fileName = 'img.jpg';
    $tmp_name = $file['tmp_name'];
  

        

    
    if(!empty($_FILES['image']['tmp_name'])){

        $infoImage = getimagesize($tmp_name);
   
    
    // pre($infoImage);
    $width  = $infoImage[0];
    $height = $infoImage[1];
    $type = $infoImage[2];

    
    





    switch($type){
        case 1:
            $img = imagecreatefromgif($tmp_name);
            break;
        case 2:
            $img = imagecreatefromjpeg($tmp_name);
            break;
        case 3:
            $img = imagecreatefrompng($tmp_name);
            break;
    }
    
    
    $w; //100    width 400
    $h; //100    height 800
    
    $tmp = imageCreateTrueColor($w, $h);

    $tw = ceil($h / ($height / $width)); //    = 50
    $th = ceil($w / ($width / $height)); //    = 200
    // if ($tw < $w) {
	imageCopyResampled($tmp, $img, 0, 0, 0, 0, $tw, $h, $width, $height);        
    // } else {
	// imageCopyResampled($tmp, $img, 0, ceil(($h - $th) / 2), 0, 0, $w, $th, $width, $height);    
    // }            
 
    $img = $tmp;

    ob_start();
    imagejpeg($img);
    $data = ob_get_clean();
    file_put_contents('uploads/img.jpg',$data);

    // move_uploaded_file($tmp_name, $img);
   }
}