<?php
$dir_name = 'images';

if (!file_exists($dir_name)) {
    if (mkdir($dir_name)) {
        echo "Директория создана" . PHP_EOL;
    }
}

if (is_dir($dir_name)) {
    echo "Это директория" . PHP_EOL;
}

if (rmdir($dir_name)) {
    echo "Директория удалена";
}