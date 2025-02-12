<?php


?>

<!-- THIS SEARCHES FOR BOXES OLDER THAN 1 DAY -->
<!-- SELECT name FROM logged_box WHERE DATEDIFF(date_create, CURRENT_TIMESTAMP) < 0; -->


<!-- sql below searches for sql with id of $box_to_target that is older than 1 day
    
 SELECT COUNT(name) FROM logged_box JOIN users_and_logged_boxes WHERE 
 users_and_logged_boxes.box_id = logged_box.id AND
 users_and_logged_boxes.box_id = $box_to_target AND 
 DATEDIFF(logged_box.date_create, CURRENT_TIMESTAMP) < 0; 
-->