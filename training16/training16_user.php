<?php
require 'training16_autoloader.php';

$user = new User(1, 'Иван', 'ivan@petrov.ru', 'hcd34879f43240f');
echo $user->getUserName() . ' ' . $user->getEmail();

echo User::getPhotoDirPath();