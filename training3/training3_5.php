<?php
// Сортировка массивов
$arr = [10, 2, 5, 8, 4, 1, 3, 6, 9, 7];

sort($arr);
print_r($arr);

rsort($arr);
print_r($arr);


// Сортировка ассоциативных массивов
$names_arr = [
    'a' => 'Алексей',
    'b' => 'Михаил',
    'c' => 'Пётр',
    'd' => 'Владимир',
    'e' => 'Сергей',
    'f' => 'Роман' 
  ];
  
asort($names_arr);
print_r($names_arr);

arsort($names_arr);
print_r($names_arr);

ksort($names_arr);
print_r($names_arr);

krsort($names_arr);
print_r($names_arr);