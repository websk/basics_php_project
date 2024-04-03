<?php

// Регистрация ошибок в  журнале ошибок

function divider(int $a, int $b)
{
    assert($b != 0, '$b не может быть равно 0');

    error_log('$b не может быть равно 0');

    return ($a/$b);
}

divider(10, 0);

// Определение обработчика ошибок

function my_error_handler($errno, $error_str, $filename, $line)
{
    echo 'Ошибка: ' . $error_str . PHP_EOL;
    echo 'В файле ' . $filename . ', строка ' . $line;
}

set_error_handler('my_error_handler');

$a + 1;