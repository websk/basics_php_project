<?php
require "sanitize.php";

const EDUCATION_SCHOOL = 'school';
const EDUCATION_HIGHER = 'higher';
const EDUCATION_OTHER = 'other';

const EDUCATIONS_ARR = [
    EDUCATION_SCHOOL => 'Среднее',
    EDUCATION_HIGHER => 'Высшее',
    EDUCATION_OTHER => 'Другое'
];

function render_form()
{
    ?>
    <form action="" method="POST" name="training_form">
        <p>
            <input type="text" name="username" size="100" maxlength="100" placeholder="Представьтесь пожалуйста" required>
        </p>
        <p>
            <input type="text" name="email" size="100" maxlength="50" placeholder="Введите Email" required>
        </p>

        <p>
            <b>Образование:</b><br>
            <?php
            foreach (EDUCATIONS_ARR as $education => $education_title) {
                $education_checked = ($education == EDUCATION_HIGHER) ? ' checked' : '';
                echo '<label>' . $education_title . ' <input type="radio" name="education" value="' . $education . '"' . $education_checked . '></label>';
            }
            ?>
        </p>

        <p>
            <b>Хочу изучить:</b><br>
            <label>PHP <input type="checkbox" name="languages[]" value="php" checked="checked"></label>
            <label>Python <input type="checkbox" name="languages[]" value="python"></label>
            <label>GoLang <input type="checkbox" name="languages[]" value="go"></label>
        </p>

        <p>
            <b>Удобное время для обучения:</b><br>
            <select name="time_for_learning">
                <option></option>
                <option value="morning">Утро, 09:00 - 12:00</option>
                <option value="day">День, 12:00 - 17:00</option>
                <option value="evening">Вечер, 17:00 - 21:00</option>
            </select>
        </p>

        <p>
            <b>Немного о себе:</b><br>
            <textarea name="about_me" cols="80" rows="10"></textarea>
        </p>

        <p>
            <input type="submit" value="Отправить заявку">
        </p>
    </form>
<?php
}

function process_form(): string
{
    $username = array_key_exists('username', $_POST) ? $_POST['username'] : '';
    $filtered_username = filter_string($username);

    $email = array_key_exists('email', $_POST) ? $_POST['email'] : '';
    $filtered_email = filter_email($email);

    $education = array_key_exists('education', $_POST) ? $_POST['education'] : '';
    $filtered_education = filter_string($education);

    $languages_arr = array_key_exists('languages', $_POST) ? $_POST['languages'] : [];
    $filtered_languages_arr = [];

    foreach ($languages_arr as $language) {
        $filtered_language = filter_string($language);

        if (!$filtered_language) {
            continue;
        }

        $filtered_languages_arr[] = $filtered_language;
    }

    $time_for_learning = array_key_exists('time_for_learning', $_POST) ? $_POST['time_for_learning'] : '';
    $filtered_time_for_learning = filter_string($time_for_learning);

    $about_me = array_key_exists('about_me', $_POST) ? $_POST['about_me'] : '';
    $filtered_about_me = filter_string($about_me);

    $errors_arr = [];

    if (!$filtered_username) {
        $errors_arr[] = 'Вы не представились';
    }

    if (!$filtered_email) {
        $errors_arr[] = 'Вы не указали Email';
    }

    if (!array_key_exists($filtered_education, EDUCATIONS_ARR)) {
        $errors_arr[] = 'Вы не заполнили образование';
    }

    if (!$filtered_languages_arr) {
        $errors_arr[] = 'Вы не выбрали ни один язык программирования';
    }

    if (count($languages_arr) != count($filtered_languages_arr)) {
        $errors_arr[] = 'Вы не корректно указали языки программирования';
    }

    if (!$filtered_time_for_learning) {
        $errors_arr[] = 'Вы не выбрали время для обучения';
    }

    $content_html = '';

    if (!$errors_arr) {
        $content_html = '<h2>' . $filtered_username . ', Ваша заявка принята, спасибо!</h2>';

        return $content_html;
    }

    $content_html .= '<p>';
    $content_html .= implode('<br>', $errors_arr);
    $content_html .= '</p>';

    return $content_html;
}

?>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Заявка на обучение по программированию</title>
</head>
<body>

<h1>Заявка на обучение по программированию</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo process_form();
} else {
    render_form();
}
?>

</body>
</html>
