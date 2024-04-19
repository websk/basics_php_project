<?php

require "mysqli.php";

$mysqli = db_connect();

$query = "INSERT INTO programming_languages (language_name, short_language_name) VALUES('C++', 'cpp')";
$result = mysqli_query($mysqli, $query);


$query = "SELECT language_name, short_language_name FROM programming_languages";
$result = mysqli_query($mysqli, $query);

if ($result === false) {
    echo "Ошибка при выполнении запроса";
}

$languages = [];

while ($row = mysqli_fetch_row($result)) {
    $languages[] = $row;
}

print_r($languages);


$query = "SELECT language_name FROM programming_languages LIMIT 3";

$stmt = mysqli_prepare($mysqli, $query);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$languages = [];

while ($row = mysqli_fetch_row($result)) {
    $languages[] = $row;
}

print_r($languages);


$query = "INSERT INTO programming_languages (language_name, short_language_name) VALUES (?, ?)";

$language_name = 'Java';
$short_language_name = 'java';

$stmt = mysqli_prepare($mysqli, $query);
mysqli_stmt_bind_param($stmt, 'ss', $language_name, $short_language_name);
mysqli_stmt_execute($stmt);


