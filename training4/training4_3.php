<?php
// Переменное число параметров функции

function my_func(...$args)
{
    foreach($args as $value) {
        echo $value . PHP_EOL;
    }
}

my_func(1, 'test', 2, 3, 'hediuewhd');

// Передача параметров функции по ссылке

function min_and_max_func(int $var_a, int $var_b = 10, &$var_min_a_b = 0): int
{

    $var_min_a_b = min($var_a, $var_b);

    return max($var_a, $var_b);
}

$a = 5;
$b = 8;
echo 'max ' . min_and_max_func($a, $b, $min_a_b) . PHP_EOL;
echo 'min ' . $min_a_b;

// Рекурсия

function calculate_factorial(int $n): int
{
    if ($n <= 0) {
        return 1;
    }

    return $n * calculate_factorial($n - 1);
}

$num = 5;
echo calculate_factorial($num);

// Анонимные функции

$hello = function(string $name) {
    return 'Привет ' . $name;
};

echo $hello('Ivan');