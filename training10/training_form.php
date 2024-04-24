<?php
require "sanitize.php";
require "programming_courses_repository.php";

const EDUCATION_SCHOOL = 'school';
const EDUCATION_HIGHER = 'higher';
const EDUCATION_OTHER = 'other';

const EDUCATION_ARR = [
    EDUCATION_SCHOOL => 'Среднее',
    EDUCATION_HIGHER => 'Высшее',
    EDUCATION_OTHER => 'Другое'
];

const PROGRAMMING_LANGUAGE_PHP = 'php';

function process_form()
{
    $errors_arr = [];

    $username = array_key_exists('username', $_POST) ? $_POST['username'] : '';
    $filtered_username = filter_string($username);

    $email = array_key_exists('email', $_POST) ? $_POST['email'] : '';
    $filtered_email = filter_email($email);

    $education_short_name = array_key_exists('education', $_POST) ? $_POST['education'] : '';
    $filtered_education_short_name = filter_string($education_short_name);
    $filtered_education_id = get_education_id_by_short_name($filtered_education_short_name);

    if (!$filtered_education_short_name) {
        $errors_arr[] = 'Вы не заполнили образование';
    } elseif (!$filtered_education_id) {
        $errors_arr[] = 'Некорректное значение для образования';
    }


    $short_languages_arr = array_key_exists('languages', $_POST) ? $_POST['languages'] : '';
    $filtered_languages_ids_arr = [];

    foreach ($short_languages_arr as $language) {
        $filtered_short_language_name = filter_string($language);

        if (!$filtered_short_language_name) {
            continue;
        }

        $programming_language_id = get_programming_language_id_by_short_language_name($filtered_short_language_name);

        if (!$programming_language_id) {
            continue;
        }

        $filtered_languages_ids_arr[] = $programming_language_id;
    }

    if (!$filtered_languages_ids_arr) {
        $errors_arr[] = 'Вы не выбрали ни один язык программирования';
    }

    if (count($short_languages_arr) != count($filtered_languages_ids_arr)) {
        $errors_arr[] = 'Вы некорректно указали языки программирования';
    }


    $learning_time_short_name = array_key_exists('time_for_learning', $_POST) ? $_POST['time_for_learning'] : '';
    $filtered_learning_time_short_name = filter_string($learning_time_short_name);
    $filtered_learning_time_id = get_learning_time_id_by_short_name($filtered_learning_time_short_name);

    if (!$filtered_learning_time_short_name) {
        $errors_arr[] = 'Вы не выбрали время для обучения';
    } elseif (!$filtered_learning_time_id) {
        $errors_arr[] = 'Некорректное время для обучения';
    }


    $about_me = array_key_exists('about_me', $_POST) ? $_POST['about_me'] : '';
    $filtered_about_me = filter_string($about_me);

    if (!$filtered_username) {
        $errors_arr[] = 'Вы не представились';
    }

    if (!$filtered_email) {
        $errors_arr[] = 'Вы некорректно указали Email';
    }


    $content_html = "";

    if ($errors_arr) {
        $content_html .= '<p>';
        $content_html .= implode('<br>', $errors_arr);
        $content_html .= '</p>';
        
        return $content_html;
    }

    foreach ($filtered_languages_ids_arr as $programming_language_id) {
        $request_id = add_request_for_training_to_db(
            $filtered_username,
            $filtered_email,
            $filtered_about_me,
            $programming_language_id,
            $filtered_education_id,
            $filtered_learning_time_id
        );
    }

    $content_html = '<h2>Ваша заявка ' . $filtered_username . ' принята, спасибо!</h2>';

    return $content_html;
}

function render_form()
{

    $mysqli = db_connect();
    ?>
    <form method="POST" name="training_form">
        <p>
            <input type="text" name="username" size="100" maxlength="100" placeholder="Представьтесь пожалуйста" required>
        </p>

        <p>
            <input type="text" name="email" size="100" maxlength="50" placeholder="Введите email" required>
        </p>

        <p>
            <b>Образование:</b><br>
            <?php
            $educations_arr = get_educations_arr();

            foreach ($educations_arr as $education_arr) {
                $education_checked = ($education_arr['short_name'] == EDUCATION_SCHOOL) ? ' checked' : '';
                echo '<label>' . $education_arr['title'] . ' <input type="radio" name="education" value="' . $education_arr['short_name'] . '"' . $education_checked . '></label><br>';
            }
            ?>
        </p>

        <p>
            <b>Хочу изучить</b><br>
            <?php
            $programming_languages_arr = get_programming_languages_arr();

            foreach ($programming_languages_arr as $programming_language_arr) {
                $checked = '';
                if ($programming_language_arr['short_language_name'] == PROGRAMMING_LANGUAGE_PHP) {
                    $checked = ' checked="checked"';
                }

                echo '<label>' . $programming_language_arr['language_name'] . ' <input type="checkbox" name="languages[]" value="' . $programming_language_arr['short_language_name'] . '" '. $checked . '></label><br>';
            }

            ?>
        </p>

        <p>
            <b>Удобное время для обучения</b><br>
            <?php
            $learning_times_arr = get_learning_times_arr();
            ?>
            <select name="time_for_learning">
                <option></option>
                <?php
                foreach ($learning_times_arr as $learning_time_arr) {
                    echo '<option value="' . $learning_time_arr['short_name'] . '">' . $learning_time_arr['title'] . '</option>';
                }
                ?>
            </select>
        </p>

        <p>
            <b>Немного о себе</b><br>
            <textarea name="about_me" cols="80" rows="10"></textarea>
        </p>

        <p>
            <input type="submit" value="Оправить заявку">
        </p>
    </form>
    <?php
}

?>

<html>
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