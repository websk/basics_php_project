<?php
require "sanitize.php";
require "mysqli.php";
require "auth.php";

function render_registration_form()
{
    ?>
    <form action="" autocomplete="off" method="post">
        <div>
            <label>Ваше имя</label>
            <div>
                <input type="text" name="username" value="">
            </div>
        </div>
        <br>
        <div>
            <label>E-mail</label>
            <div>
                <input type="text" name="email" value="">
            </div>
        </div>
        <br>
        <div>
            <label>Пароль</label>
            <div>
                <input type="password" name="password_first">
            </div>
        </div>
        <div>
            <label class="col-md-4 control-label">Подтверждение пароля</label>
            <div>
                <input type="password" name="password_second">
            </div>
        </div>
        <br>
        <div>
            <label>Немного о себе:</label>
            <div>
                <textarea name="about_me" cols="80" rows="10"></textarea>
            </div>
        </div>

        <p>
            <input type="submit" value="Зарегистрироваться">
        </p>
    </form>
<?php
}

function process_registration_form(): string
{
    $errors_arr = [];

    $username = array_key_exists('username', $_POST) ? $_POST['username'] : '';
    $filtered_username = filter_string($username);

    if (!$filtered_username) {
        $errors_arr[] = 'Вы не представились';
    }

    $email = array_key_exists('email', $_POST) ? $_POST['email'] : '';
    $filtered_email = filter_email($email);

    if (!$filtered_email) {
        $errors_arr[] = 'Вы не указали Email';
    }

    $about_me = array_key_exists('about_me', $_POST) ? $_POST['about_me'] : '';
    $filtered_about_me = filter_string($about_me);

    $password_first = array_key_exists('password_first', $_POST) ? $_POST['password_first'] : '';
    $filtered_password_first = filter_string($password_first);

    $password_second = array_key_exists('password_second', $_POST) ? $_POST['password_second'] : '';
    $filtered_password_second = filter_string($password_second);

    if (!$filtered_password_first || !$filtered_password_second) {
        $errors_arr[] = 'Вы не указали пароль';
    }

    if ($filtered_password_first !== $filtered_password_second) {
        $errors_arr[] = 'Пароль не подтвержден, либо подтвержден неверно';
    }

    $content_html = '';

    if ($errors_arr) {
        $content_html .= '<p>';
        $content_html .= implode('<br>', $errors_arr);
        $content_html .= '</p>';

        return $content_html;
    }

    $password_hash = generate_password($filtered_password_first);

    $user_id = registration_user_to_db($filtered_username, $filtered_email, $password_hash, $filtered_about_me);

    if ($user_id !== false) {
        $content_html .= 'Вы успешно зарегистрировались на сайте';
    }

    return $content_html;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Курсы по изучению языков программирования - Регистрация пользователя</title></head>
<body>

<h1>Регистрация на сайте</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo process_registration_form();
} else {
    render_registration_form();
}
?>

</body>
</html>
