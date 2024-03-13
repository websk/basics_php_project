<?php
// Уникализация массивов

$arr = [1, 2, 3, 3, 4, 5, 5, 6, 7, 8, 7, 9, 10];

$arr_uniq = array_unique($arr);

print_r($arr_uniq);