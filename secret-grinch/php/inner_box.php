<?php
session_start();
require_once "../model/Users.php";
require_once "../model/Logged_Box.php";
require_once "../model/UALB.php";

$nickname = $_SESSION['auth']["nick"];
$usr_data = Users::get_by_name($nickname);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/inner_box_logged.css">
    <title>Inner Box</title>
</head>
<body>
<div class="background">
        <?php include_once('../php/header.php') ?>
        
        <h1 id="box_roof"><?php echo "Коробка " . $_SESSION['box']["box_name"] ?></h1>
        <form id="form_box" class="mb24" method="POST" action="../php/inner_box.php">
        <?php  
        $added_user_name = "user_name1";
        $index = 0;
    
    for ($i=0; $i < $_SESSION['box']["user_amount"]; $i++) { 
        $added_user_name = substr($added_user_name, 0, -1);
        $index++;
        $added_user_name .= $index;
       
        ?>
        
        <input onblur="saveName(this, <?php echo  $index ?>)" id="<?php echo "box_field_" . $index ?>" required class="box_input mb24" type="text" name="<?php echo $added_user_name ?>" placeholder="Введите Имя <?php echo $index ?> Участника"></input>
        <br>
        <?php 
        } ?>
        <input type="submit" value="Подтвердить" name="submit" id="btn_submit" class="fs24"> </input>
    </form>

    <?php   
            if (isset($_POST["submit"]) and $_SESSION['box']['box_type'] == 'logged') {
                    
                   

                for ($i=0; $i < $_SESSION['box']["user_amount"]; $i++) { 
                  
                    try {
                        $santa_name = $_POST["user_name".($i+1)];
                        $participant = Users::get_by_name($santa_name);
                    } catch (\Throwable $th) {
                        echo $th->getMessage();
                    }
                    
                    $data_user_added = [
                        "user_id"=> $participant["id"],
                        "box_id"=> $_SESSION['box']["box_id"]
                    ];
                    UALB::add($data_user_added);     
                }
                unset($_SESSION['box']);
                header("Location:../php/usr_page.php");
            }elseif (isset($_POST["submit"]) and $_SESSION['box']['box_type'] == 'quick') {
                
                    $participants = [];
    
                    for ($i=0; $i < $_SESSION['box']["user_amount"]; $i++) { 
                            $santa_name = $_POST["user_name".($i+1)];
                            array_push($participants, $santa_name);
                        }


                        shuffle($participants);
                        $santas = $participants;
                        $var = $participants[0];
                        array_shift($participants);
                        
                        $participants[$_SESSION['box']["user_amount"]-1] = $var;
                        // echo count($participants);
    
                        // echo "<pre>";
                        // print_r($participants);
                        // echo "</pre>";
    
                        // echo "<br>";
                        // echo "<pre>";
                        // print_r($santas);
                        // echo "</pre>";
                        $_SESSION["shuffle"] = [
                            'santas' => $santas,
                            'participants' => $participants
                        ];
                    unset($_SESSION['box']);
                    header("Location:../php/quick_results.php");
                }
        ?>

    <?php include_once('../php/footer.php') ?>
    </div>
    <script src="../js/inner_box_logged.js"></script>
    <script src="../js/inner_box_logged_setfounder.js"></script>
    <?php 
            if ($_SESSION['box']['founder_participation']) {
              ?>
              <script>
                  setFounder('<?php echo $_SESSION['auth']['nick'] ?>')
              </script>
              <?php
            }
            ?>
</body>
</html>


