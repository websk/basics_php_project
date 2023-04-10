<?php
$mysqli = mysqli_connect("127.0.0.1", "root", "root", "programming_courses");
/*
if ($mysqli === false) {
    echo "Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error();
}

$languages = [];
$query = "SELECT language_name FROM programming_languages LIMIT 10";
$stmt = mysqli_prepare($mysqli, $query);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
while ($row = mysqli_fetch_row($result)) {
    $languages[] = $row;
}

print_r($languages);

*/

/*
try {
    mysqli_begin_transaction($mysqli);

    mysqli_query($mysqli, "INSERT INTO programming_languages (language_name, short_language_name) VALUES ('PHP', 'php')");

    $programming_language_id = mysqli_insert_id($mysqli);

    mysqli_query($mysqli, "INSERT INTO request_for_training (username, email, programming_language_id) VALUES ('Vasily', 'vasy@mail.ru', $programming_language_id)");

    mysqli_commit($mysqli);
} catch (mysqli_sql_exception $exception) {
    mysqli_rollback($mysqli);

    throw $exception;
}
*/

$db = new PDO("mysql:host=127.0.0.1;dbname=programming_courses", "root", "root");

$stmt = $db->prepare("SELECT language_name FROM programming_languages WHERE short_language_name = ?");
$stmt->execute(['php']);
$stmt->debugDumpParams();
