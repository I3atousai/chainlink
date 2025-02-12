<?php

session_start();

class Guard
{
    public static function only_guest()
    {
        if (isset($_SESSION['auth']) ) {
            header("Location:../php/usr_page.php");
        }
       
    }
    public static function only_user()
    {
        if (!isset($_SESSION['auth'])) {
            header("Location:../php/choice.php");
        }
    }
}
