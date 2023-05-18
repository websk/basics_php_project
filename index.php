<?php
require "sanitize.php";
require "auth.php";

function render_login_form()
{
    ?>
    <form method="post">
        <p>
            <label>Email</label>
            <input type="text" name="email">

            <label>Пароль</label>
            <input type="password" name="password">
        </p>
        <p>
            <input type="submit" value="Войти">
        </p>
    </form>

    <p>
        <a href="/registration.php">Регистрация</a>
    </p>
    <?php
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
        $errors_arr[] = 'Вы не указали Пароль';
    }

    $user_id = get_user_id_by_email_and_password($email, $password);
    if (!$user_id) {
        $errors_arr[] = 'Вы указали неправильный email или пароль для входа';
    }

    $content_html = '';

    if ($errors_arr) {
        $content_html .= '<p>';
        $content_html .= implode('<br>', $errors_arr);
        $content_html .= '</p>';

        return $content_html;
    }

    set_user_session_id($user_id);

    $content_html .= 'Вы успешно авторизовались<br>';
    $content_html .= '<a href="/training_form.php">Отправить заявку на обучение по программированию</a>';

    return $content_html;
}


$user_id = get_current_user_id();
if ($user_id) {
    header('Location: /training_form.php');
}
?>
<!DOCTYPE html>
<html lang="ru"> <head>
    <meta charset="UTF-8">
    <title>Курсы по изучению языков программирования</title>
</head>
<body>

<h1>Курсы по изучению языков программирования</h1>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    echo login();
} else {
    render_login_form();
}
?>

</body>
</html>
