<?php

require 'training16_autoloader.php';

$user = new User(1,'Ivan', 'ivan@mail.ru', 'dc3h49f84f4');
$cloned_user = clone $user;

echo $user->getUserName() . ' ';
echo $cloned_user->getUserName();