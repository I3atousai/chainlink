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