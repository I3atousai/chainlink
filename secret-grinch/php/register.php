<?php
require_once "../model/Users.php";
require_once "../Service/Guard.php";
Guard::only_guest();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/register.css">

    <title>Registration</title>
</head>
<body>
  <div class="background">
    <div class="container">
            <h1 class="fs40 mb32 text_blur">Регистрация</h1>
            <form  class="form-1 mb60" method="POST" action="../php/register.php">
              <input required class="mb8" type="text" name="nick" placeholder="Создайте Псевдоним" />
              <input required class="mb8" type="email" name="email" placeholder="Email" />
              <input required
                class="mb8"
                pattern="[a-z0-9]{8,}"
                type="password"
                name="password"
                placeholder="Пароль более 8 символов"
              />
              <button class="btn-1 fs24">Подтвердить</button>
            </form>
    <?php
    
    $nickname = $_POST['nick'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $usr_data = ["name"=> $nickname,
                 "email"=> $email,
                 "password"=> $password];
    echo Users::add($usr_data);
    ?>
          </div>

    <?php include_once('../php/footer.php') ?>  
    </div>
  </body>
    
</html>
