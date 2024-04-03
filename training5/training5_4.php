<?php
// Исключения

function divider(int $a, int $b)
{
    
    if ($b == 0) {
        throw new Exception('Деление на ноль');
    }

    return ($a/$b);
}

try {
    echo divider(10, 0);
} catch (\Exception $exception) {
    echo 'Исключение: ' . $exception->getMessage();
}