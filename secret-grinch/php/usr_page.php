<?php
    session_start();

    if (isset($_POST["submit_exit"])) {
        header("Location:../php/index.php");
        unset($_SESSION['auth']);
        
    }

    require_once "../model/Users.php";
    require_once "../model/Logged_Box.php";
    require_once "../model/UALB.php";
    require_once "../Service/Guard.php";
    Guard::only_user();
    $nick = $_SESSION['auth']["nick"];
    $usr_id = $_SESSION['auth']["logged_user_id"];

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/usr_page.css">
    <title>My Page</title>
</head>
<body>
<div class="background">
    <style></style>

        <?php include_once('../php/header.php') ?>
        <main >
            <div id="snow-globe">

                <div id="usr_desc">
                    <img id="PFP" src="<?php echo $_SESSION['auth']["PFP_path"] ?>" alt="pfp">
                     
                    <?php echo "<h4 id =\"name\">" .  $nick . "</h4>"?>
                </div>
                
                <h3 id="my_boxes">Мои коробки </h3>
            </div>

    <?php  
        $get = [
            "lb.founder_id",
            "lb.name",
            "lb.id"
        ];
        $tables = ["logged_box as lb"];
        $params = [
            ["lb.founder_id", "=", $usr_id, "system"]
        ];
    
        try {
            $boxes_arr = LB::query(get:$get, tables:$tables, params:$params) ;
            $box_amount = count($boxes_arr);
            setcookie('box_amount', $box_amount);
            } catch (\Throwable $th) {
                echo $th->getMessage();
                echo "<br>";
            }
       
    ?>
    <div id="box_wrap">

        <?php
        
        for ($i=0; $i < $box_amount; $i++) { 
            // sql updates 
            include('../php_components/usr_list_upd.php');
            ?>
                <div class="box">
                    <div class="box_top"></div>
                    <form class="box_bottom" action="../php/usr_page.php" method="POST">
                        <h3>
                            <?php echo $boxes_arr[$i]["name"];?>
                        </h3>
                        <?php include('../php_components/box_user_info_access.php') ?>
                        <h3 class="usr_count">
                            <?php echo "Кол.-во участников: " . $user_amount ?>
                        </h3>
                        <input type="button" onclick="toggleVisibility(<?php echo $i ?>)" class="usr_list_show" id="<?php echo "box_users_show_" . $i ?>" value="Санты" name="<?php echo "open_list" . $i ?>">
                                                                                            <!-- User list tag insertion here -->
                            <div class="usr_list" id="<?php echo("box_users_" . $i) ?>" > <?php include('../php_components/usr_list.php') ?> </div>  
                        </input>
                        <input for="box_bottom" class="del_button" type="submit" value="Удалить" name="<?php echo "delete_box" . $i ?>"> </input>
                    </form>
                   

                </div>
                <?php 

            
                    }
                     ?>

    </div>
    
        
</main>
        <form id="exit" action="../php/usr_page.php" method="post">
                <input onclick="clearLocalStorage()" type="submit" value="Выйти" name="submit_exit" id="exit" class="btn-1 fs24"> </input>
        </form>
      
        <?php include_once('../php/footer.php') ?>
    </div>

    <script src="../js/usr_page.js"></script>
</body>
</html>