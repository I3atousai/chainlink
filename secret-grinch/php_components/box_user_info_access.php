<?php
 $get = [
    "ualb.user_id",
    "ualb.box_id",
    "ualb.id"
];
$tables = ["users_and_logged_boxes as ualb"];
$params = [
    ["ualb.box_id", "=", $boxes_arr[$i]["id"], "system"]
];
try {
   $UABoxes_arr = UALB::query(get:$get, tables:$tables, params:$params);
    $user_amount = count($UABoxes_arr);
} catch (\Throwable $th) {
    echo $th->getMessage();
} 
?>