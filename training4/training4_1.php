<?php
// Ссылки. Присвоение по ссылке

$var1 = 'value1';
$var2 = &$var1;
$var2 = 'value2';

echo $var1;


$arr = [
    'el1' => 'value1',
    'el2' => 'value2'
];

$arr_link = &$arr['el1'];
$arr_link = 'new value 1';

echo $arr['el1'];
