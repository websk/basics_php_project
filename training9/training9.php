<?php
require "../programming_courses/mysqli.php";

$mysqli = db_connect();

$mysqli = db_connect();

$query = "INSERT INTO programming_languages (language_name, short_language_name) VALUES ('PHP', 'php')";

$result = mysqli_query($mysqli, $query);

if ($result === false) {
    echo 'Ошибка при выполнении запроса';
}

$query = "SELECT language_name, short_language_name FROM programming_languages";

$result = mysqli_query($mysqli, $query);

if ($result === false) {
    echo 'Ошибка при выполнении запроса';
}

$languages = [];

while ($row = mysqli_fetch_row($result)) {
    $languages[] = $row;
}

print_r($languages);

try {
    mysqli_begin_transaction($mysqli);

    $query = "INSERT INTO programming_languages SET language_name = ?, short_language_name = ?";
    $statement = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($statement, 'ss', ...['PHP', 'php']);
    mysqli_stmt_execute($statement);

    $programming_language_id = mysqli_insert_id($mysqli);


    $query = "INSERT INTO request_for_training SET username = ?, programming_language_id = ?, email = ?";
    $statement = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($statement, 'ssis', ...['Vasily', $programming_language_id, 'vasy@mail.ru']);
    mysqli_stmt_execute($statement);

    mysqli_commit($mysqli);
} catch (mysqli_sql_exception $exception) {
    mysqli_rollback($mysqli);
}






