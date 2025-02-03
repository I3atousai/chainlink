<?php 

use App\Helpers\Navigate;
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
session_start();
?>
<main>
    
    <form class="mb8" action="<?php Navigate::middleware('public/add_link') ?>" method="post">
        <input id="link_input" maxlength="200" class="fs24" type="text" name="long_link">
        <button id="chain_link" class="bold fs16" type="submit">Сократить</button>
    </form>
    <h2 class="mb16">Короткая ссылка</h2>
    <div class="short fs20">
    <?php
      echo  isset($_SESSION['last_short']) ?  $_POST['short_link'] = Navigate::link('links/', mode:"return") . $_SESSION['last_short'] : "Здесь будет сокращенная ссылка"
    ?>
    </div>
</main>