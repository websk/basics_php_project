<?php
require "sanitize.php";
require "mysqli.php";
require "auth.php";

if (isset($_COOKIE[USERS_SESSION_COOKIE_NAME])) {
    $user_sesion_id = get_user_id_by_session_id($_COOKIE[USERS_SESSION_COOKIE_NAME]);
    if ($user_sesion_id) {
        header('Location: /training_form.php');
    }
}
function login(): string
{
    $errors_arr = [];

    $email = array_key_exists('email', $_POST) ? $_POST['email'] : '';
    $filtered_email = filter_email($email);

    if (!$filtered_email) {
        $errors_arr[] = 'Вы не указали Email';
    }

    $password = array_key_exists('password', $_POST) ? $_POST['password'] : '';
    $filtered_password = filter_string($password);

    if (!$filtered_password) {
        $errors_arr[] = 'Вы не указали пароль';
    }

    $user_id = get_user_id_by_email_and_password($filtered_email, $filtered_password);

    if ($user_id === false) {
        $errors_arr[] = 'Вы указали неправильный email или пароль для входа';
    }

    $content_html = '';

    if ($errors_arr) {
        $content_html .= '<p>';
        $content_html .= implode('<br>', $errors_arr);
        $content_html .= '</p>';

        return $content_html;
    }

    setcookie(USERS_SESSION_COOKIE_NAME, generate_user_cookie_hash($user_id), strtotime('+30 days'));

    $content_html .= 'Вы успешно авторизовались';

    return $content_html;
}


function render_login_form()
{
    ?>
    <form action="" method="post">
        <p>
            <label>Email</label>
            <input type="text" name="email">

            <label>Пароль</label>
            <input type="password" name="password">
        </p>
        <p>
            <button type="submit">Войти</button>
        </p>
        <p>
            <a href="registration.php">Регистрация</a>
        </p>
    </form>
<?php
}
?>


<!DOCTYPE html>
<html lang="ru"> <head>
    <meta charset="UTF-8">
    <title>Курсы по изучению языков программирования</title> </head>
<body>

<h1>Курсы по изучению языков программирования</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo login();
} else {
    render_login_form();
}
?>

</body>
</html>
