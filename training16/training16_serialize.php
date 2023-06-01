<?php
function my_autoloader(string $class) {
    include 'classes/' . $class . '.php';
}

spl_autoload_register('my_autoloader');

$user = new User(1,'Ivan', 'ivan@mail.ru', 'dc3h49f84f4');

$serialized_user = serialize($user);

echo $serialized_user;