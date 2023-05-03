<?php
$filename = 'about_php.txt';

if (file_exists($filename)) {
    echo "Файл существует" . PHP_EOL;
}

if (is_file($filename)) {
    echo "Это файл" . PHP_EOL;
}

if (is_writable($filename)) {
    echo "Файл доступен для записи" . PHP_EOL;
}

$new_filename = 'about_php_clone.txt';
if (copy($filename, $new_filename)) {
    echo "Файл скопирован" . PHP_EOL;
}

$tmp_new_filename = 'about_php_clone.tmp';
if (rename($new_filename, $tmp_new_filename)) {
    echo "Файл переименован" . PHP_EOL;
}

if (unlink($tmp_new_filename)) {
    echo "Файл удален" . PHP_EOL;
}