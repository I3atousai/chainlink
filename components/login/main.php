<?php

use App\Helpers\Navigate;

?>

<main>
    <div class="container">
        <h1 class="fs40 mb32">Вход</h1>
        <form class="form-1 mb60" method="post" action="<?php Navigate::middleware("public/login") ?>">
            <input required class="mb8" type="text" name="login" placeholder="Имя или почта">
            <input required class="mb8" type="password" name="password" placeholder="*******">
            <button class="btn-1 fs24 mb8">Войти</button>
            <a href="<?php Navigate::view("public/reset_password") ?>" class="btn-1 fs16">Забыл пароль</a>
        </form>
    </div>
</main>