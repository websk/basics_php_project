<?php
require_once "mysqli.php";

function get_programming_languages_arr(): array
{
    $programming_languages_arr = fetch_all_from_query("SELECT id, language_name, short_language_name FROM programming_languages ORDER BY language_name");

    return $programming_languages_arr;
}

function get_educations_arr(): array
{
    $educations_arr = fetch_all_from_query("SELECT title, short_name FROM educations ORDER BY title");

    return $educations_arr;
}

function get_learning_times_arr(): array
{
    $learning_times_arr = fetch_all_from_query("SELECT id, title, short_name FROM learning_times ORDER BY title");

    return $learning_times_arr;
}

function get_education_id_by_short_name(string $education_short_name): ?int
{
    $mysqli = db_connect();

    $query = "SELECT id FROM educations WHERE short_name = ?";
    $statement = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($statement, 's', ...[$education_short_name]);
    mysqli_stmt_execute($statement);

    $result = mysqli_stmt_get_result($statement);

    if ($result === false) {
        return null;
    }

    $row = mysqli_fetch_assoc($result);

    return $row['id'];
}

function get_programming_language_id_by_short_language_name(string $short_language_name): ?int
{
    $mysqli = db_connect();

    $query = "SELECT id FROM programming_languages WHERE short_language_name = ?";
    $statement = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($statement, 's', ...[$short_language_name]);
    mysqli_stmt_execute($statement);

    $result = mysqli_stmt_get_result($statement);

    if ($result === false) {
        return null;
    }

    $row = mysqli_fetch_assoc($result);

    return $row['id'];
}

function get_learning_time_id_by_short_name(string $learning_time_short_name): ?int
{
    $mysqli = db_connect();

    $query = "SELECT id FROM learning_times WHERE short_name = ?";
    $statement = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($statement, 's', ...[$learning_time_short_name]);
    mysqli_stmt_execute($statement);

    $result = mysqli_stmt_get_result($statement);

    if ($result === false) {
        return null;
    }

    $row = mysqli_fetch_assoc($result);

    return $row['id'];
}

function add_request_for_training_to_db(
    int $user_id,
    int $programming_language_id,
    ?int $learning_time_id = null,
    ?int $education_id = null
): bool|int
{
    $mysqli = db_connect();

    $query = "INSERT INTO request_for_training SET user_id = ?, programming_language_id = ?, learning_time_id = ?, education_id = ?";
    $statement = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param(
        $statement,
        'iiii',
        ...[$user_id, $programming_language_id, $learning_time_id, $education_id]
    );
    mysqli_stmt_execute($statement);

    $request_id = mysqli_insert_id($mysqli);

    return $request_id;
}

function get_request_for_training_rows(int $programming_language_id, int $learning_time_id): array
{
    $mysqli = db_connect();

    $query = "SELECT users.username, users.user_photo, educations.title AS education_title FROM request_for_training"
        . " LEFT JOIN users ON request_for_training.user_id = users.id"
        . " LEFT JOIN educations ON request_for_training.education_id = educations.id"
        . " WHERE request_for_training.programming_language_id = ? AND request_for_training.learning_time_id = ?";

    $statement = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($statement, 'ii', ...[$programming_language_id, $learning_time_id]);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    if ($result === false) {
        return [];
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}