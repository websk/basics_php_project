<?php
// Слабая типизация
echo 1 + '2';
?>

<?php
// В двойных кавычках имена переменных интерполируются (расширяются), а в одинарных — нет
$a = "true";
$b = "my method is $a";

echo $b;

$a = "true";
$b = 'my method is $a';

echo $b;

$a = "true";
$b = 'my method is "' . $a . '"';

echo $b;

$a = "true";

$b = 'my method is "';
$b .= $a;
$b .= '"';

echo $b;
?>

<?php
// Конкатенация строк
$a = 'Иван' . ' Иванович' . ' Иванов';
echo $a;
?>

<?php
// Предопределенные константы
$a = "Jon" . PHP_EOL;
echo $a;

$b = 'Smit';
echo $b;