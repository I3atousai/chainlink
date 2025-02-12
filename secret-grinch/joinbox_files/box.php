<?php  
session_start();
// require_once "Users.php";
// require_once "UALB.php";
// $nickname = $_SESSION["nick"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/box.css">
    <title>Box</title>
</head>
<body>
<div class="background">
        <?php include_once('../php/header.php') ?>
        

<form id="form_box" class="mb60" method="POST" action="../php/box.php">
          <input required class="box_input mb8" type="text" name="box_name" placeholder="Введите Имя Коробки"/>
          <label for="box_name"></label>
          <br>
          <input min="3" max="40" required class="box_input mb8" type="number" name="user_amount" placeholder="Введите Количество Сант" />
          <br>
          <div id="radio_box" class="mb24">
              <input checked type="radio" name="box_type" id="logged" value="logged"><label for="logged">Обычная коробка</label>
              <input type="radio" name="box_type" id="quick" value="quick"><label for="quick">Быстрая жеребьевка</label>
              <input type="checkbox" name="im_in" id="im_in"><label for="im_in">Я учатсвую</label>
          </div>
            
          <input  type="submit" value="Подтвердить" name="submit" class="btn-1 fs24"> </input>
         
        </form>
        <?php   
            if (isset($_POST["submit"]) and $_POST['box_type'] == "logged") {
                require_once "../model/Logged_Box.php";
                $hash_to_add = password_hash($_POST["box_name"], PASSWORD_DEFAULT);
                $data_box = [
                    "name" => $_POST["box_name"],
                    "founder_id" => $_SESSION['auth']["logged_user_id"],
                    "join_hash " => $hash_to_add
                    ];
                LB::add($data_box);
                // echo"<pre>";
                // print_r($data_box);
                // echo("</pre>");
                
                $_SESSION['box'] = [
                    'box_id' => LB::get_by_name($_POST["box_name"])["id"],
                    'box_type' => 'logged',
                    'box_name' => $_POST["box_name"],
                    'user_amount' => $_POST["user_amount"],
                    'founder_id' => $_SESSION['auth']["logged_user_id"],
                    'founder_participation' => $_POST['im_in']
                ];
                setcookie('user_amount', $_POST["user_amount"]);
                header("Location:../php/inner_box.php");
            }
            elseif(isset($_POST["submit"]) and $_POST['box_type'] == 'quick') {

                $_SESSION['box'] = [
                    'box_name' => $_POST["box_name"],
                    'box_type' => 'quick',
                    'user_amount' => $_POST["user_amount"],
                    'founder_id' => $_SESSION['auth']["logged_user_id"],
                    'founder_participation' => $_POST['im_in']
                ];
                setcookie('user_amount', $_POST["user_amount"]);

                header("Location:../php/inner_box.php");
            }
        ?>

<?php include_once('../php/footer.php') ?>
</div>
</body>
</html>