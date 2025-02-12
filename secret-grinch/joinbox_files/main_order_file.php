<?php 
session_start();

require_once "../model/Logged_Box.php";
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
       
            // ob_start();
            // include("../joinbox_files/join_santa.php");
            // $message = ob_get_clean();

            // THIS SHIT WORKS
            $message = file_get_contents('../joinbox_files/template.php',TRUE);

            $boxes_arr = LB::get_by_name('santa');
            $myfile = fopen("join_". $boxes_arr['name'] . "1.php" , "w") or die("Unable to open file!");
            fwrite($myfile, $message);
            fclose($myfile);
            ?>
         
        <?php
        ?>

        <?php include_once('../php/footer.php') ;
        unset($_SESSION['sql_del'])?>
    </div>
</body>
</html>

?>