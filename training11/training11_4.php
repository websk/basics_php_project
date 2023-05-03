<?php
$filename = 'educations.csv';

$fp = fopen($filename, 'a');
if ($fp) {
    $row_str = PHP_EOL . '4;Специальное;special';

    fwrite($fp, $row_str);

    fclose($fp);
}

$fp = fopen($filename, 'r');

if ($fp) {
    while (($row = fgetcsv($fp, null, ';')) !== false) {
        for ($column = 0; $column < count($row); $column++) {
            echo $row[$column] . PHP_EOL;
        }

        echo '---' . PHP_EOL;
    }

    fclose($fp);
}