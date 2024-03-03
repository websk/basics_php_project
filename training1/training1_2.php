<?php
// Пробелы и разрывы строк

// Нормальное представление
function calculate_numbers($a, $b, $c) {
    return $a +$b + $c;
}
?>

<?php
// Без пробелов
function calculate_numbers($a,$b,$c){return $a+$b+$c;}
?>

<?php
// Разбивка на несколько строк
function calculate_numbers(
    $a,
    $b,
    $c
)
{
    return $a + $b + $c;
}
?>
