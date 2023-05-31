<?php
function my_autoloader(string $class) {
    include 'classes/' . $class . '.php';
}

spl_autoload_register('my_autoloader');

echo \Education::EDUCATION_SCHOOL;