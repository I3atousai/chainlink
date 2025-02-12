<?php 

require_once "../Service/Guard.php";
Guard::only_guest();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/choice.css">
    <title>Тайный Гринч</title>
</head>
<body>
<div class="background">
<?php include_once('../php/header.php') ?>
    <div class="container">
        <nav>
            <a class="fs24 bold" href="../php/register.php">Создать новый Аккаунт</a>
            <a class="fs24 bold mb60" href="../php/login.php">Войти</a>
        </nav>
    </div>

<?php include_once('../php/footer.php') ?>
</div>
</body>
</html>