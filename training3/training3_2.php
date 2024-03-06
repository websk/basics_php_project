<?php

$my_arr = [1, 2, 3, 4, 5];


// Циклы while do-while

$i = 0;

while ($i < count($my_arr)) {
    echo $my_arr[$i] . PHP_EOL;
    $i++;
}

echo PHP_EOL;

$i = 0;
do {
    if ($i == 3) {
        break;
    }

    echo $my_arr[$i] . PHP_EOL;
    $i++;
} while ($i < count($my_arr));

echo PHP_EOL;


// Цикл for

for ($i = 0; $i < count($my_arr); $i++) {
    echo $my_arr[$i] . PHP_EOL;
}

echo PHP_EOL;

for ($i = count($my_arr) - 1; $i >=0; $i--) {
    echo $my_arr[$i] . PHP_EOL;
}


echo PHP_EOL;

for ($i = 0; $i < count($my_arr); $i++) {
    if ($my_arr[$i] % 2) {
        echo 'Н ' . $my_arr[$i] . PHP_EOL;
        continue;
    }
   
    echo 'Ч ' . $my_arr[$i] . PHP_EOL;
}


// Цикл foreach

$assoc_arr = [
    'key1' => 'value1',
    'key2' => 'value2',
    'key3' => 'value3'
];

foreach ($assoc_arr as $key => $value) {
    echo $key . ' - ' . $value . PHP_EOL;
}