<?php
require 'training16_autoloader.php';

$anonymous = new class(1, 'Ivan', 'ivan@mail.ru', 'dc3h49f84f4') extends User {
    public function getUsername(): string
    {
        return $this->username . ' Anonymous';
    }
};

echo $anonymous->getUserName();