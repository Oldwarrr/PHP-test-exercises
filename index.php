<?php

session_start();
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/functions.php';


if(!empty($_POST)){
    // debug($_POST);
    $fields = load($fields);
    // debug($fields);
    if( $errors = validate($fields)){
        debug($errors);
    }else{
        write($fields);
        echo "<li style='font-size:20px; width: 300px; word-wrap: break-word'>Форма отправлена успешно!</li>";
    }
}

if(isset($_POST['action']) && $_POST['action']){
    if(!move_uploaded_file($_FILES['file']['tmp_name'], "E:/openserver/domains/form-2d/" . $_FILES['file']['name'])){
        echo "<li style='font-size:20px; width: 300px; word-wrap: break-word; margin-left: 20px'>Не удалось загрузить файл</li>";
    }
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="button.css">
</head>



<body>
    <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="name">Имя</label>
    <input name="name" id="name" type="text" >
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input name="email" id="email" type="email" >
</div>

<div class="form-group">
    <label for="address">Адрес</label>
    <input name="address" id="address" type="text">
</div>

<div class="form-group">
    <label for="phone">Телефон</label>
    <input name="phone" id="phone" type="tel" >
</div>

<div class="form-group">
    <label for="comment">Комментарий</label>
    <textarea name="comment" id="comment"></textarea>
</div>


<div class="form-group">
    <label for="captcha"> <?= set_captcha() ?></label>
    <input name="captcha" id="captcha" type="text" >
</div>

<div class="form-group">
<label for="agree" class="agree">
<input type="checkbox" name="agree" id="agree" >
<span class="fake"></span>
<label for="agree">Даю согласие на обработку моих персональных данных</label>
</div>
<input type="hidden" name="action" value="true">
<input class="file" type="file" name="file" accept=".png,.jpeg,.jpg">
<button class="btn" type="submit">Отправить</button>
<a class="btn" href="output.php" name="data" type="submit">Данные</a>








</form>
</body>
</html>