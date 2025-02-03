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
          <form  class="form-1" method="POST"    action="../recovery/gundam17.php"><input required
                class="mb8"
                pattern="[a-z0-9]{8,}"
                type="password"
                name="password"
                placeholder="Пароль более 8 символов"
              />
            <button class="btn-1 fs24" name="submit">Подтвердить</button>
          </form>
          <?php
  if (isset($_GET['password_recovery_hash'])) {
    # code...
    $_SESSION['password_recovery_hash'] = $_GET['password_recovery_hash'];
  }
  if (isset($_POST["submit"])) {$password_reset_hash ="2y10v62xjLwKdYCgFsUA0tQ4ewVLtxDnAcYAy5kXNlNv5AVidsJxPqu";
$user_id ="17";
date_default_timezone_set('Russia/Moscow');
            $date_now = date('Y-m-d h:i:s ', time());

      $get = [
    //    "DATEDIFF(users.pass_reset_time, " . $date_now . ') as diff',
        "users.pass_reset_hash"
    ];
    $tables = ["users"];
    $params = [
        ["users.id", "=", $user_id, "value"]
    ];
    $reset_time = User::query(get:$get, tables:$tables, params:$params, fetch_mode:'one') ;
     // if ($reset_time['diff'] < -1) {
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
            ['password_hash' => $password_new,
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
    ?>
    </div>
</main> <?php
    Component::render("public/foot");
    ?>