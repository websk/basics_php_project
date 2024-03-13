<?php
// Многомерные массивы

$users_arr = [
    'petr97' => [
        'name' => 'Petr',
        'age' => 25
    ],
    'ivan_tr' => [
        'name' => 'Ivan',
        'age' => 36
    ],
    'mria' => [
        'name' => 'Maria',
        'age' => 28
    ]
];

foreach ($users_arr as $login => $user_arr) {
    foreach ($user_arr as $key => $value) {
        echo $key . ' - ' . $value . PHP_EOL;
    }

    echo PHP_EOL;
}

// Ключи массива

print_r(array_keys($users_arr));

// Значения массива

print_r(array_values($users_arr));

// Срез

print_r(array_slice($users_arr, 1, 2));