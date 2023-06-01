<?php
function my_autoloader(string $class) {
    include 'classes/' . $class . '.php';
}

spl_autoload_register('my_autoloader');

$anonymous = new class(1, 'Ivan', 'ivan@mail.ru', 'dc3h49f84f4') extends User {
    public function getUsername(): string
    {
        return $this->username . ' Anonymous';
    }
};

var_dump($anonymous);