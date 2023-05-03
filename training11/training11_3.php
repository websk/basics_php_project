<?php
// Побайтовое чтение
$filename = "about_php.txt";

$stream = fopen($filename, "r");
$contents = fread($stream, filesize($filename));
fclose($stream);
echo $contents;

// Построчное чтение

$fp = fopen($filename, "r");
if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        echo $buffer;
    }
    fclose($fp);
}

// Запись в файл
$new_content = PHP_EOL . 'Я изучаю PHP';
$fp = fopen($filename, 'a');
if ($fp) {
    if (fwrite($fp, $new_content)) {
        echo "Записали в файл";
    }

    fclose($fp);
}


// file_get_contents
$content_html = file_get_contents('http://localhost');
echo $content_html;


// file_get_contents и file_put_contents
$new_content = PHP_EOL . 'Я изучаю PHP';
$content = file_get_contents($filename);
$content .= $new_content;
file_put_contents($filename, $content);


// file()
$filename = 'about_php.txt';
$content_arr = file($filename);
var_dump($content_arr);