<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Model\User;
use App\Helpers\Navigate;
use App\Service\Guard;

Guard::only_guest();


$user = User::query(
    get: ["*"],
    fetch_mode: "one",
    params: [
        ["name", "=", $_POST['login'], 'value','OR'],
        ["email", "=", $_POST['login'], 'value'],
    ]
);

if (
    $user &&
    password_verify($_POST['password'], $user['password_hash'])
) {
    $_SESSION['auth'] = [
        'role' => 'user',
        'id' => $user['id']
    ];
    Navigate::view("users/profile", [], "redirect");
}

die("Пользователь не найден/Неправильный пароль");
