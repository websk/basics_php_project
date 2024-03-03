<?php
// Преобразование типов
$a = 2.75;
$b = (int) $a;
echo $b;
?>

<?php
// Переменные
$variable = 1;
$Variable = 2;
$VARIABLE = 3;

echo $variable . PHP_EOL;
echo $Variable . PHP_EOL;
echo $VARIABLE . PHP_EOL;
?>

<?php
// Примеры недопустимых имен переменных:
$my variable = 1;
$ = 2;
$1variable = 3;
?>

<?php
// Стандарты именования переменных
$my_variable = 4; // underscore
$myVariable = 5; // CamelCase

class MyClass{} // UpperCamelCase
?>


