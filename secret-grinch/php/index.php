<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <title>Main page</title>
</head>
<body>
    <div class="background">
        <?php include_once('../php/header.php') ?>
        <div id="index_grid">
            <div class="describtion_box">
                <h2 class="mb16">Как это работает</h2>
                <p>Создайте коробку, указав вид коробки, название коробки и количество участников</p>
            </div>
            <img src="../img/screen1.png" alt="desc_img1">
            <div>
                <img src="../img/back2.png" alt="desc_img2">
                <img src="../img/back2.png" alt="desc_img3">
            </div>
            <div class="describtion_box">
                <h2 class="mb16">Виды жеребьевки</h2>
                <p>Быстрая жеребьевка
                   Обычная коробка
                </p>
            </div>

        </div>
        <?php include_once('../php/footer.php') ;
        unset($_SESSION['sql_del'])?>
    </div>
</body>
</html>