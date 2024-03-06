<?php
// Количество элементов в массиве
$my_arr = [1, 2, 3, 4, 5];
echo count($my_arr);


// Проверка, что массив не пустой

$my_arr = [];
if (count($my_arr)) {
    echo 1;
} else {
    echo 2;
};


// Слияние массивов

$fruits_arr = ["Яблоки" => "Гольден", "Виноград" => "Изабелла"];
$vegetables_arr = ["Огурцы" => "Короткоплодные", "Томаты" => "Розовые"];

$food_arr = $fruits_arr + $vegetables_arr;

print_r($food_arr);


$array1 = ['first_element', 'second_element', 'third_element'];
$array2 = ['fourth_element', 'fifth_element'];
$array3 = ['sixth_element'];

$arr = $array1 + $array2 + $array3;

print_r($arr);

$arr = array_merge($array1, $array2, $array3);
print_r($arr);

// Проверка на существование

$fruits_arr = ["Яблоки" => "Гольден", "Виноград" => "Изабелла"];

isset($fruits_arr["Яблоки"]) . PHP_EOL;

array_key_exists("Яблоки", $fruits_arr) . PHP_EOL;

in_array("Гольден", $fruits_arr);


// Работа с символами строки как с элементами массива

$str = 'Ivanov Petr Ivanovich';
echo $str[2];


// Разбиение строки на массив

$arr = explode(' ', $str);
print_r($arr);

echo implode(' ', $arr);

