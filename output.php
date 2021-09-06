<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'

?>

<body>
    <div>
    <a href="index.php" class="btn">Назад к форме</a>
    <div class="img"><?php include('show.view.php') ?></div>
    </div>
    <p class="data"><?= data() ?></p>
</body>
</html>