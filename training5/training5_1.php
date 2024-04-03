<?php
// Изменение настроек в процессе выполнения кода

error_reporting(E_ALL);
ini_set("display_errors", 0);

echo ini_get("memory_limit");

calculate_numbers();


print_r(ini_get_all());

print_r(ini_get_all("mysqlnd"));