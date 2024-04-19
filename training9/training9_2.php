<?php

require "mysqli.php";

$mysqli = db_connect();

try {
    mysqli_begin_transaction($mysqli);

    $query = "INSERT INTO programming_languages (language_name, short_language_name) VALUES (?, ?)";
    $stmt = mysqli_prepare($mysqli, $query);

    $language_name = 'Java';
    $short_language_name = 'java';

    mysqli_stmt_bind_param($stmt, 'ss', $language_name, $short_language_name);
    mysqli_stmt_execute($stmt);
    $programming_language_id = mysqli_insert_id($mysqli);

    $query = "INSERT INTO request_for_training (username, programming_language_id, email) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, 'sis', ...['Vasily', $programming_language_id, 'vasy@mail.ru']);
    mysqli_stmt_execute($stmt);

    mysqli_commit($mysqli);
} catch (mysqli_sql_exception $exception) {
    mysqli_rollback($mysqli);
}