<?php
// Конструкция if-else-elseif

$a = 1;

if ($a == 1) {
    echo 1;
} elseif ($a == 2) {
    echo 2;
}  elseif ($a == 3) {
    echo 3;
} else {
    echo 4;
}

if ($a >= 1) {
    if ($a == 1) {
        echo 1;
    } elseif ($a == 2) {
        echo 2;
    } else {
        echo 3;
    }
} else {
    echo 5;
}


// Конструкция switch-case

switch ($a) {
    case 1:
        echo 1;
        break;
    case 2:
        echo 2;
        break;
    case 3:
        echo 3;
        break;
    default:
        echo 4;
}


// Тернарный оператор

echo ($a >= 1) ? (($a == 1) ? 1 : 2) : 3;