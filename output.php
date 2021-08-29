<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/output.css">
</head>
<body>
    <a href="index.php" class="btn">Назад к форме</a>
    <div class="img"><?php include('show.view.php') ?></div>
    <p><?= data() ?></p>
</body>
</html>