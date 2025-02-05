<?php 

use App\Model\Link;
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

$search = Link::query(get:['long_link'],fetch_mode:'one', params: [['short_link', '=', $_GET['s'], 'value']]);
if ($search) {
    header('Location: ' . $search['long_link']);
} else {
 echo 'Ссылки не существует';
}


?>