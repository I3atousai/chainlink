<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Helpers\Component;
use App\Controller\RecoveryController;
use App\Model\User;
use App\Helpers\Navigate;
$data = RecoveryController::index();


Component::render("public/head");
?>
<div class="container">
           <h1 class="fs40 mb32 text_blur">Новый пароль</h1> <!-- first cut in action below -->
          <form  class="form-1" method="POST"    

<?php


if (isset($_GET['password_recovery_hash'])) {
    # code...
    $_SESSION['password_recovery_hash'] = $_GET['password_recovery_hash'];
  }
  if (isset($_POST["submit"])) {
$password_reset_hash ="2y101nId33Jmm3u2npKryPhNrlyK516IF3Dfq0q91IdxqcAnSENvgV2";
$user_id ="16";

date_default_timezone_set('Russia/Moscow');
$date_now = date('Y-m-d h:i:s ', time());

$get = [
        "users.pass_reset_hash"
    ];
    $tables = ["users"];
    $params = [
      ["users.id", "=", $user_id, "value"]
    ];
    $reset_time = User::query(get:$get, tables:$tables, params:$params, fetch_mode:'one') ;
    ?>
            <p id="failed_login_message"><?php echo "Прошло слишком много времени, ссылка недействительна"; ?> </p>
            <?php
        if ($_SESSION['password_recovery_hash'] != $reset_time['pass_reset_hash']) {
          ?>
            <p id="failed_login_message"><?php echo "Ссылка повреждена"; ?> </p>
            <?php
        } else {
          
          $password_new = password_hash($_POST['password'], PASSWORD_DEFAULT);
          
          User::update(
            ['password' => $password_new,
            'pass_reset_hash' => "NULL"
          ],
          [
            ['id', '=', $user_id, 'value']
            ]
          );
          ?>
              <p id="failed_login_message"><?php echo "Восстановление пароля прошло успешно"; ?> </p>
              <?php
        sleep(4);
        header( Navigate::view('public/login', mode:'return'));
      }
    }
    Component::render("public/foot");
    ?>