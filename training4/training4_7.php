<?php
// Работа с датой и временем

echo time() . PHP_EOL;

// Время выполнения скрипта

$start_time = microtime(true);

for ($i = 1; $i <= 1000000; $i++);

$end_time = microtime(true);

$script_time_ms = round($end_time - $start_time, 5);

echo 'Script Time: ' . $script_time_ms;