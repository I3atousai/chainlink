<?php 
// sql updates 
    include('../php_components/usr_list_upd.php');
    ?>
        <p class="founder_name mb8"><?php echo $_SESSION['auth']['nick'] ?></p>
        
    <?php
    for ($u=0; $u < $user_amount; $u++) { 
        $user_to_get = $UABoxes_arr[$u]['user_id'];

        $box_user = Users::get_one($user_to_get);
                ?>
            
            <p><?php echo $box_user['name'] ?> <button name="<?php echo("del_user_number_" . $i . $u) ?>" id="<?php echo("del_user_number_" . $i . $u) ?>" class="del_user_button" type="submit" value="sublit"></button></p>
            <hr class="mb8"/>
            <?php
        }
?>