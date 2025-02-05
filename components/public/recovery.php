<?php

use App\Helpers\Navigate;


?>
<main>
    <div class="container">
        <h1 class="fs40 mb32">Восстанволение Пароля</h1>
        <form  class="form-1" method="POST" action="<?php Navigate::middleware('public/recovery') ?>">
            <input class=" mb8" required class="mb8" type="email" name="email" placeholder="Введите свою почту" />
            <button class="btn-1 fs24" name="submit">Подтвердить</button>
        </form>
    </div>
</main>