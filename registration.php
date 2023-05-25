<?php
require "sanitize.php";
require "auth.php";

function render_registration_form()
{
    ?>
    <form method="post" enctype="multipart/form-data">
        <p>
            <input type="text" name="username" size="100" maxlength="100" placeholder="Представьтесь пожалуйста"
                   required>
        </p>
        <p>
            <input type="text" name="email" size="100" maxlength="50" placeholder="Введите Email" required>
        </p>

        <p>
            <b>Пароль</b><br>
            <input type="password" name="password_first">
            <br>
            <b>Подтверждение пароля</b><br>
            <input type="password" name="password_second">
        </p>

        <p>
            <b>Немного о себе:</b><br>
            <textarea name="about_me" cols="80" rows="10"></textarea>
        </p>

        <p>
            <b>Ваша фотография:</b><br>
            <input type="file" name="user_photo" required>
        </p>

        <p>
            <b>Введите код, изображенный на картинке</b><br>
            <img src="/captcha.php" alt="Captcha" title="Введите этот защитный код">
            <input type="text" name="captcha" size="5" required>
        </p>

        <p>
            <input type="submit" value="Зарегистрироваться">
        </p>
    </form>

    <p>
        <a href="/">Авторизация</a>
    </p>
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

    if (!$password_first || !$password_second) {
        $errors_arr[] = 'Вы не указали пароль';
    }

    if ($filtered_password_first !== $filtered_password_second) {
        $errors_arr[] = 'Пароль не подтвержден, либо подтвержден неверно.';
    }

    $user_photo = upload_user_photo();
    if (!$user_photo) {
        $errors_arr[] = 'Не удалось загрузить фотографию';
    }


    $captcha = array_key_exists('captcha', $_POST) ? $_POST['captcha'] : '';
    $captcha_cookie = array_key_exists('captcha', $_COOKIE) ? $_COOKIE['captcha'] : '';

    if ($captcha != $captcha_cookie) {
        $errors_arr[] = 'Вы неверно ввели код, изображенный на картинке';
    }


    $content_html = '';

    if ($errors_arr) {
        $content_html .= '<p>';
        $content_html .= implode('<br>', $errors_arr);
        $content_html .= '</p>';

        return $content_html;
    }


    $user_id = registration_user_to_db($filtered_username, $filtered_email, $filtered_password_first, $filtered_about_me, $user_photo);

    if (!$user_id) {
        $content_html .= 'Не удалось зарегистрировать пользователя';
        return $content_html;
    }

    $content_html .= 'Вы успешно зарегистрировались<br>';
    $content_html .= '<a href="/">Войти на сайт</a>';

    return $content_html;
}

function upload_user_photo(): ?string
{
    if (!isset($_FILES['user_photo'])) {
        return false;
    }

    $filename = $_FILES['user_photo']['name'];
    $tmp_path = $_FILES['user_photo']['tmp_name'];

    $photo_dir = 'photo';
    if (!file_exists($photo_dir)) {
        mkdir($photo_dir);
    }

    $new_path = __DIR__ . DIRECTORY_SEPARATOR . $photo_dir . DIRECTORY_SEPARATOR . $filename;

    if (!move_uploaded_file($tmp_path, $new_path)) {
        return null;
    }

    resize_image($new_path, $new_path, 200, 80);

    return $filename;
}

function resize_image(string $src, string $dest, int $width_resize_value, int $quality): bool
{
    if (!file_exists($src)) {
        return false;
    }

    $size_arr = getimagesize($src);
    if ($size_arr === false) {
        return false;
    }

    $format = substr($size_arr['mime'], strpos($size_arr['mime'], '/') +1);
    $image_func = 'imagecreatefrom' . $format;

    if (!function_exists($image_func)) {
        return false;
    }

    $image_src = $image_func($src);

    $dest_width = $width_resize_value;
    $ratio = $size_arr[0] / $dest_width;
    $dest_height = round($size_arr[1] / $ratio);

    $image_dest = imagecreatetruecolor($dest_width, $dest_height);
    $white = imagecolorallocate($image_dest, 255, 255, 255);
    imagefill($image_dest, 0, 0, $white);

    imagecopyresampled($image_dest, $image_src, 0, 0, 0, 0, $dest_width, $dest_height, $size_arr[0], $size_arr[1]);

    $format_output_func = 'image' . $format;
    if (!function_exists($format_output_func)) {
        return false;
    }

    if ($format == 'png') {
        $quality = ceil($quality / 10);
    }

    $format_output_func($image_dest, $dest, $quality);

    imagedestroy($image_src);
    imagedestroy($image_dest);

    return true;
}

?>
<!DOCTYPE html>
<html lang="ru"> <head>
    <meta charset="UTF-8">
    <title>Курсы по изучению языков программирования - Регистрация пользователя</title>
</head>
<body>
<h1>Регистрация пользователя</h1>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    echo  process_registration_form();
} else {
    render_registration_form();
}
?>

</body>
</html>
