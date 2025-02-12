<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/quick_results.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <title>Main page</title>
</head>
<body>
    <div class="background">
        <?php include_once('../php/header.php') ?>
            <div id="quick_grid" class="mb60">
                <section class="participants">
                    <h2 class="mb32">Санта</h2>
                    <?php 
                        for ($i=0; $i < count($_SESSION["shuffle"]['santas']); $i++) { 
                            ?>
                                <p class="mb16 participant_name"><?php echo $_SESSION["shuffle"]['santas'][$i] ?></p>
                            <?php
                        }
                    ?>
                </section>
                <section class="participants">
                    <h2 class="mb32">Подопечный</h2>
                    <?php 
                        for ($i=0; $i < count($_SESSION["shuffle"]['participants']); $i++) { 
                            ?>
                                <p class="mb16 participant_name"><?php echo $_SESSION["shuffle"]['participants'][$i] ?></p>
                            <?php
                        }
                    ?>
                </section>
            </div>
        <?php include_once('../php/footer.php') ;
        unset($_SESSION['sql_del'])?>
    </div>
</body>
</html>