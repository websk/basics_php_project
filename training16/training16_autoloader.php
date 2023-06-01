<?php
function my_autoloader(string $class_name) {
    include 'classes/' . $class_name . '.php';
}

spl_autoload_register('my_autoloader');

echo \Education::EDUCATION_SCHOOL;