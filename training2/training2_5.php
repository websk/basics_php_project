<?php
// Магические числа и строки

$euros_count = 1000;
$dollars_count = $euros_count * 1.25; // 1250
$rubles_count = $dollars_count * 60;  // 75000

echo $rubles_count;
?>

<?php

$dollars_per_euro = 1.25;
$rubles_per_dollar = 60;

$euros_count = 1000;
$dollars_count = $euros_count * $dollars_per_euro; // 1250
$rubles_count = $dollars_count * $rubles_per_dollar;  // 75000

echo $rubles_count;
