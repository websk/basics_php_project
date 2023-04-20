<?php
const MYSQL_HOSTNAME = 'localhost';
const MYSQL_USERNAME = 'ranepauser';
const MYSQL_PASSWORD = '12345';
const MYSQL_DATABASE = 'programming_courses';

function db_connect(): mysqli
{
    static $mysqli;

    if (!is_null($mysqli)) {
        return $mysqli;
    }

    $mysqli = mysqli_connect(MYSQL_HOSTNAME, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

    if ($mysqli === false) {
        throw new \Exception('Неудачная попытка соединения' . mysqli_connect_error());
    }

    return $mysqli;
}