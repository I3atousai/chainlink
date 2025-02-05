<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use App\Model\User;


  if (isset($_POST["submit"])) {
      try {
          
        $get = [
            "u.id",
            "u.name"
        ];
        $tables = ["users as u"];
        $params = [
            ["u.email", "=", $_POST['email'], "value"]
        ];
        $user = User::query(get:$get, tables:$tables, params:$params, fetch_mode:'one') ;


        if (!isset($user['name'])) {
            ?>
            <p id="failed_login_message"><?php echo "Пользователя с такой почтой не сущестувет"; ?> </p>
          <?php
        }else {
            $hash_to_add = password_hash($_POST["email"], PASSWORD_DEFAULT);
            $hash_to_add = str_replace( array( '\'', '"',',' , ';', '<', '>','$', '.', '/', '\\', '|' ), '', $hash_to_add);

            date_default_timezone_set('Russia/Moscow');
            $date_now = date('Y-m-d h:i:s ', time());

            User::update(
                ['pass_reset_time' => $date_now,
                        'pass_reset_hash' => $hash_to_add],
                [
                    ['id', '=', $user['id'], 'value']
                ]
            );
            $santa_email = $_POST['email'];
            $santa_name = $user['name'];


            //make a reset file here
            $message = file_get_contents('../recovery/php_templates/template_first_half.php',TRUE);
            $message .= "action=\"" . '..' . "/recovery/" . $user['name']. $user['id'] . ".php\">";
            $message .= file_get_contents('../recovery/php_templates/template_second_half.php',TRUE);
            $message .=  "\$" . 'password_reset_hash ="' . $hash_to_add . "\";\n";
            $message .=  "\$" . 'user_id ="' . $user['id'] . "\";\n";
            $message .= file_get_contents('../recovery/php_templates/template_third_half.php',TRUE);
            
            $myfile = fopen('../recovery/'.$user['name']. $user['id'] . ".php"  , "w") or die("Unable to open file!");
            fwrite($myfile, $message);
            fclose($myfile);
            
            
            $subject = "Восстановление пароля ";
            
            $message = file_get_contents('../recovery/mail/mail_to_santa_first.html',TRUE);
            $message .= $user['name'];
            $message .= file_get_contents('../recovery/mail/mail_to_santa_second.html',TRUE);
            $message .= file_get_contents('../recovery/mail/mail_to_santa_third.html',TRUE);
            $message .= file_get_contents('../recovery/mail/mail_to_santa_fourth.html',TRUE);
            $message .= $user['name']. $user['id'] . ".php?password_recovery_hash=" . $hash_to_add ;
            $message .= file_get_contents('../recovery/mail/mail_to_santa_fifth.html',TRUE);
           
           ?>  <p id="failed_login_message"><?php echo "Письмо было отправлено на вашу почту"; ?> </p>   <?php
       
            $headers  = "From: " . "grinchsecret@gmail.com" . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            try {
              mail($santa_email, $subject , $message,$headers);
            } catch (\Throwable $th) {
              echo $th->getMessage();
            }
    }
} catch (\Throwable $th) {
echo $th->getMessage();
}
}