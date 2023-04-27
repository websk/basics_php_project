<?php
require "mysqli.php";

function get_programming_languages_arr(): array
{
    $programming_languages_arr = fetch_all_from_query("SELECT language_name, short_language_name FROM programming_languages ORDER BY language_name");

    return $programming_languages_arr;
}

function get_educations_arr(): array
{
    $educations_arr = fetch_all_from_query("SELECT title, short_name FROM educations ORDER BY title");

    return $educations_arr;
}

function get_learning_times_arr(): array
{
    $learning_times_arr = fetch_all_from_query("SELECT title, short_name FROM learning_times ORDER BY title");

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
    string $username,
    string $about_me,
    int $programming_language_id,
    string $email,
    ?int $learning_time_id = null,
    ?int $education_id = null
): bool|int
{
    $mysqli = db_connect();

    $query = "INSERT INTO request_for_training SET username = ?, about_me = ?, programming_language_id = ?, email = ?, learning_time_id = ?, education_id = ?";
    $statement = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param(
        $statement,
        'ssisii',
        ...[$username, $about_me, $programming_language_id, $email, $learning_time_id, $education_id]
    );
    mysqli_stmt_execute($statement);

    $request_id = mysqli_insert_id($mysqli);

    return $request_id;
}