<?php 
session_start();
require_once "../model/UALB.php";   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <title>Main page</title>
</head>
<body>
    <div class="background">
        <?php include_once('../php/header.php') ?>
        <?php  
        if (!isset($_SESSION['auth'])) {
            echo "Только зарегистрированные пользлватели могут присоеденяться к коробкам";
        }
        else {
            $box_id_to_add = '17';

            $data_user_added = [
                "user_id"=> $_SESSION['auth']['logged_user_id'],
                "box_id"=> $box_id_to_add
            ];
            UALB::add($data_user_added);  
        }
        ?>
        <?php include_once('../php/footer.php') ;
        unset($_SESSION['sql_del'])?>
    </div>
    <!-- work with this -->
    <script src="../js/template.js"></script>
    <script>
            setFounder('<?php echo $boxes_arr['join_hash'] ?>')
    </script>
</body>
</html>