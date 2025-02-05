<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Helpers\Component;
use App\Controller\RecoveryController;
use App\Model\User;
use App\Helpers\Navigate;
$data = RecoveryController::index();


Component::render("public/head");
?>
<main>
<div class="container">
           <h1 class="fs40 mb32 text_blur">Новый пароль</h1> <!-- first cut in action below -->
          <form  class="form-1" method="POST"    