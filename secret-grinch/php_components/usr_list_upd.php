<?php

    for ($l=0; $l < $user_amount; $l++) { 
        $user_to_get = $UABoxes_arr[$l]['user_id'];

        $box_user = Users::get_one($user_to_get);

        if (isset($_POST["del_user_number_" . $i . $l])) {

            $params_ualb_user = [
            ["box_id", "=", $boxes_arr[$i]["id"], "AND"],
            ["user_id", "=", $box_user['id']]
            ];
             UALB::delete($params_ualb_user);
             unset($_POST["del_user_number_" . $i . ($l)]);
             header("Location:../php/usr_page.php");
            }
    }
    
?>
<?php 
    if (isset($_POST["delete_box" . $i])) {

        $params_ualb = [
        ["box_id", "=", $boxes_arr[$i]["id"]]
        ];
    UALB::delete($params_ualb);

        $params_box = [
            ["id", "=", $boxes_arr[$i]["id"]]
        ];
    LB::delete($params_box);
    header("Location:../php/usr_page.php");
    }
?>