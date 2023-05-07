<?php

const SECRET_SALT = 'fhc92h39g8hwolfh23ofg';

const USERS_SESSION_COOKIE_NAME = 'user_session';

function generate_password(string $password): string
{
    $password_hash = md5(SECRET_SALT . $password);

    return $password_hash;
}

function generate_user_cookie_hash(int $user_id): string
{
    return md5(SECRET_SALT . $user_id);
}

function registration_user_to_db(string $username, string $email, string $password, string $about_me, string $user_photo): bool|int
{
    $mysqli = db_connect();

    $query = "INSERT INTO users SET username = ?, email = ?, password = ?, about_me = ?, user_photo = ?";
    $statement = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($statement, 'sssss', ...[$username, $email, $password, $about_me, $user_photo]);
    mysqli_stmt_execute($statement);

    $user_id = mysqli_insert_id($mysqli);

    return $user_id;
}

function get_user_id_by_email_and_password(string $email, string $password)
{
    $mysqli = db_connect();

    $query = "SELECT id FROM users WHERE email = ? AND password = ?";
    $statement = mysqli_prepare($mysqli, $query);

    $password_hash = generate_password($password);

    mysqli_stmt_bind_param($statement, 'ss', ...[$email, $password_hash]);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    if ($result === false) {
        return false;
    }

    $row = mysqli_fetch_assoc($result);
    $user_id = $row['id'];

    return $user_id;
}

function get_user_id_by_session_id(string $session_id)
{
    $mysqli = db_connect();

    $query = "SELECT id FROM users WHERE session_id = ?";
    $statement = mysqli_prepare($mysqli, $query);

    mysqli_stmt_bind_param($statement, 's', ...[$session_id]);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    if ($result === false) {
        return false;
    }

    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        return false;
    }

    $user_id = $row['id'];

    return $user_id;
}

function get_user_arr_by_user_id(int $user_id): ?array
{
    $mysqli = db_connect();

    $query = "SELECT id, username, email, about_me, user_photo FROM users WHERE id = ?";
    $statement = mysqli_prepare($mysqli, $query);

    mysqli_stmt_bind_param($statement, 'i', ...[$user_id]);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    if ($result === false) {
        return null;
    }

    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        return null;
    }

    return $row;
}

function get_user_id(): ?int
{
    $session_id = $_COOKIE[USERS_SESSION_COOKIE_NAME] ?? null;
    if (!$session_id) {
        return null;
    }

    return get_user_id_by_session_id($session_id);
}

function set_user_session_id(int $user_id)
{
    $session_id = generate_user_cookie_hash($user_id);

    setcookie(USERS_SESSION_COOKIE_NAME, $session_id, strtotime('+30 days'));

    $mysqli = db_connect();

    $query = "UPDATE users SET session_id = ? WHERE id = ?";
    $statement = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($statement, 'si', ...[$session_id, $user_id]);
    mysqli_stmt_execute($statement);
}
