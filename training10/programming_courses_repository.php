<?php

require_once "mysqli.php";

function get_programming_languages_arr(): array
{
    $query = "SELECT language_name, short_language_name FROM programming_languages ORDER BY language_name";

    return fetch_all_from_query($query);
}

function get_educations_arr(): array
{
    $query = "SELECT title, short_name FROM educations ORDER BY title";

    return fetch_all_from_query($query);
}

function get_learning_times_arr(): array
{
    $query = "SELECT title, short_name FROM learning_times ORDER BY title";

    return fetch_all_from_query($query);
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

    if (!array_key_exists('id', $row)) {
        return null;
    }

    return $row['id'];
}

function get_education_id_by_short_name(string $short_name): ?int
{
    $mysqli = db_connect();

    $query = "SELECT id FROM educations WHERE short_name = ?";
    $statement = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($statement, 's', ...[$short_name]);
    mysqli_stmt_execute($statement);

    $result = mysqli_stmt_get_result($statement);

    if ($result === false) {
        return null;
    }

    $row = mysqli_fetch_assoc($result);

    if (!array_key_exists('id', $row)) {
        return null;
    }

    return $row['id'];
}

function get_learning_time_id_by_short_name(string $short_name): ?int
{
    $mysqli = db_connect();

    $query = "SELECT id FROM learning_times WHERE short_name = ?";
    $statement = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($statement, 's', ...[$short_name]);
    mysqli_stmt_execute($statement);

    $result = mysqli_stmt_get_result($statement);

    if ($result === false) {
        return null;
    }

    $row = mysqli_fetch_assoc($result);

    if (!array_key_exists('id', $row)) {
        return null;
    }

    return $row['id'];
}

function add_request_for_training_to_db(
    string $username,
    string $email,
    string $about_me,
    int $programming_language_id,
    ?int $education_id = null,
    ?int $learning_time_id = null
    ): int|bool
{
    $mysqli = db_connect();
    $query = "INSERT INTO request_for_training (username, email, about_me, programming_language_id, education_id, learning_time_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, 'sssiii', ...[$username, $email, $about_me, $programming_language_id, $education_id, $learning_time_id]);
    mysqli_stmt_execute($stmt);

    $request_id = mysqli_insert_id($mysqli);

    return $request_id;
}