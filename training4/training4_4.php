<?php
// Функции для работы со строками

// Длина строки strlen()
$str = 'abcdefgh';
$str_cyr = 'абвгдежз';

echo strlen($str) . PHP_EOL;
echo mb_strlen($str_cyr) . PHP_EOL;

// Поиск по строке strpos() и strrpos()
echo strpos($str, 'cd');

// Обрезание пробельных символов
$str_for_trim = ' odifeowif ';
echo '|' . trim($str_for_trim) . '|' . PHP_EOL;
echo '|' . ltrim($str_for_trim) . '|' . PHP_EOL;
echo '|' . rtrim($str_for_trim) . '|' . PHP_EOL;

// Замена внутри строки
echo str_replace(',', '', $str);

// Изменение регистра символов
echo strtoupper($str) . PHP_EOL;
echo strtolower($str) . PHP_EOL;
echo ucfirst($str);
