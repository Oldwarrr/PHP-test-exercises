<?php

session_start();


//REQUIRE FUNCTIONS
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';



$fields = [
    'name' => [
        'field_name' => 'Имя',
        'required' => 1
    ],

    'email' => [
        'field_name' => 'Email',
        'required' => 1
    ],

    'address' => [
        'field_name' => 'Адрес',
        'required' => 0
    ],

    'phone' => [
        'field_name' => 'Телефон',
        'required' => 1
    ],
    'os' => [
        'field_name' => 'Операционная система',
        'required' => 1
    ],
    'comment' => [
        'field_name' => 'Комментарий',
        'required' => 0
    ],
    'agree' => [
        'field_name' => 'Согласие<br> на обработку персональных данных',
        'required' => 1
    ],
    'captcha' => [
        'field_name' => 'Captcha',
        'required' => 1
    ],
    ];




    // REQUIRE HEADER
require_once $_SERVER['DOCUMENT_ROOT'] . '/header.php';
?>





<body>

<p class="announce">
<?
if(!empty($_POST)){
    // debug($_POST);

    uploadImage($_FILES['image']);  
    
    $fields = load($fields);
    // debug($fields);
    if( $errors = validate($fields)){
        debug($errors);
    }else{
        write($fields);
        echo "<li style='font-size:20px; width: 300px; word-wrap: break-word'>Форма отправлена успешно!</li>";
    }
}


if(isset($_FILES['csv'])){
    uploadFileCsv($_FILES['csv']);
}
        
    



?>


</p>




    <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form">

<div class="form_main">
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







<div class="os">
    <p class="choice-os">Выберите вашу ОС :</p>
    <div class="radio-group">
        <div class="windows">
        <label class="radio-btn" for="windows">
            <input type="radio" name="os" id="windows" value="Windows">
            <span class="fake-radio windows-icon"></span>
            <p>Windows</p>
        </label>
        </div>

        <div class="mac">
            <label class="radio-btn" for="mac">
                <input type="radio" name="os" id="mac" value="Mac OS">
                <span class="fake-radio mac-icon"></span>
                <p>Mac OS</p>
            </label>
        </div>

    </div>


</div>


<input type="hidden" name="action" value="true">
<input class="file" type="file" name="image" accept=".png,.jpeg,.jpg">


<div class="form-check">
    <div class="form-group">
        <label for="captcha"> <?= set_captcha() ?></label>
        <input name="captcha" id="captcha" type="text" >
    </div>
</div>


<div class="form-group">
<label for="agree" class="agree">
<input type="checkbox" name="agree" id="agree" >
<span class="fake"></span>
<label for="agree">Даю согласие на обработку моих персональных данных</label>
</div>

<div class="btns-group">
    <button class="btn" type="submit">Отправить</button>
    <a class="btn" href="output.php" name="data" type="submit">Данные</a>
    </div>

</div>


</form>


<div class="get-and-out">
    <form method="POST" enctype="multipart/form-data">
    <label for="file">Выберите загружаемый CSV файл</label>
        <input id="file" type="file" accept=".csv" name="csv">
        <button class="btn" type="submit">Загрузить</button>
    </form>
    
    <? require('get-and-out.php') ?>
</div>


</body>
</html>