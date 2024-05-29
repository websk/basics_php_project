<?php
require 'training16_autoloader.php';

if (class_exists('User')) {
    echo 'class User exists';
}

print_r(get_declared_classes());

print_r(get_class_methods('User'));

print_r(get_class_vars(get_class($user)));


if (method_exists('User', 'getUserName')) {
    echo 'Метод getUserName существует';
}

if (property_exists('User', 'username')) {
    echo 'Свойство username существует';
}