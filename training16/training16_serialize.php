<?php
require 'training16_autoloader.php';

$user = new User(1,'Ivan', 'ivan@mail.ru', 'dc3h49f84f4');

$serialized_user = serialize($user);

echo $serialized_user;