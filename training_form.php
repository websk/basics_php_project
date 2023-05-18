<?php
require "sanitize.php";
require "programming_courses_repository.php";
require "auth.php";

const EDUCATION_SCHOOL = 'school';
const PROGRAMMING_LANGUAGE_PHP = 'php';

function render_form()
{
    ?>
    <form action="" method="POST" name="training_form" enctype="multipart/form-data">
        <p>
            <b>Образование:</b><br>
            <?php
            $educations_arr = get_educations_arr();

            foreach ($educations_arr as $education_arr) {
                $education_checked = ($education_arr['short_name'] == EDUCATION_SCHOOL) ? ' checked' : '';
                echo '<label>' . $education_arr['title'] . ' <input type="radio" name="education" value="' . $education_arr['short_name'] . '"' . $education_checked . '></label>';
            }
            ?>
        </p>

        <p>
            <b>Хочу изучить:</b><br>
            <?php
            $programming_languages_arr = get_programming_languages_arr();

            foreach ($programming_languages_arr as $programming_language_arr) {
                $checked = '';
                if ($programming_language_arr['short_language_name'] == PROGRAMMING_LANGUAGE_PHP) {
                    $checked = ' checked="checked"';
                }
                echo '<label>' . $programming_language_arr['language_name'] . ' <input type="checkbox" name="languages[]" value="' . $programming_language_arr['short_language_name'] . '"' . $checked . '></label>';
            }
            ?>
        </p>

        <p>
            <b>Удобное время для обучения:</b><br>
            <select name="learning_time">
                <option></option>
                <?php
                $learning_times_arr = get_learning_times_arr();

                foreach ($learning_times_arr as $learning_time_arr) {
                    echo '<option value="' . $learning_time_arr['short_name'] . '">' . $learning_time_arr['title'] . '</option>';
                }
                ?>
            </select>
        </p>

        <p>
            <input type="submit" value="Отправить заявку">
        </p>
    </form>

    <p>
        <a href="/training_list.php">Список обучающихся</a>
        / <a href="/logout.php">Выход</a>
    </p>
    <?php
}

function process_form(): string
{
    $errors_arr = [];

    $education_short_name = array_key_exists('education', $_POST) ? $_POST['education'] : '';
    $filtered_education_short_name = filter_string($education_short_name);

    $filtered_education_id = get_education_id_by_short_name($filtered_education_short_name);

    if (!$filtered_education_short_name) {
        $errors_arr[] = 'Вы не заполнили образование';
    } else if (!$filtered_education_id) {
        $errors_arr[] = 'Некорректное значение для образования';
    }


    $short_languages_names_arr = array_key_exists('languages', $_POST) ? $_POST['languages'] : [];
    $filtered_programming_languages_ids_arr = [];

    foreach ($short_languages_names_arr as $short_language) {
        $filtered_short_language = filter_string($short_language);

        if (!$filtered_short_language) {
            continue;
        }

        $programming_language_id = get_programming_language_id_by_short_language_name($filtered_short_language);

        if (!$programming_language_id) {
            continue;
        }

        $filtered_programming_languages_ids_arr[] = $programming_language_id;
    }

    if (!$filtered_programming_languages_ids_arr) {
        $errors_arr[] = 'Вы не выбрали ни один язык программирования';
    }

    if (count($short_languages_names_arr) != count($filtered_programming_languages_ids_arr)) {
        $errors_arr[] = 'Вы не корректно указали языки программирования';
    }


    $learning_time_short_name = array_key_exists('learning_time', $_POST) ? $_POST['learning_time'] : '';
    $filtered_learning_time_short_name = filter_string($learning_time_short_name);

   $filtered_learning_time_id = get_learning_time_id_by_short_name($filtered_learning_time_short_name);

    if (!$filtered_learning_time_short_name) {
        $errors_arr[] = 'Вы не выбрали время для обучения';
    } else if (!$filtered_learning_time_id) {
        $errors_arr[] = 'Некорректное время для обучения';
    }


    $content_html = '';

    if ($errors_arr) {
        $content_html .= '<p>';
        $content_html .= implode('<br>', $errors_arr);
        $content_html .= '</p>';

        return $content_html;
    }

    $user_id = get_current_user_id();

    $user_arr = get_user_arr_by_user_id($user_id);

    foreach ($filtered_programming_languages_ids_arr as $programming_language_id) {
        $request_id = add_request_for_training_to_db(
            $user_id,
            $programming_language_id,
            $filtered_learning_time_id,
            $filtered_education_id
        );

        if ($request_id === false) {
            continue;
        }

        $content_html .= '<h2>' . $user_arr['username'] . ', Ваша заявка ' . $request_id . ' принята, спасибо!</h2>';
    }

    $content_html .= '<p>';
    $content_html .= '<a href="/training_list.php">Список обучающихся</a>';
    $content_html .= ' / <a href="/training_form.php">Отправить заявку</a>';
    $content_html .= '</p>';

    return $content_html;
}

$user_id = get_current_user_id();
if (!$user_id) {
    header('Location: /');
}
?>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Курсы по изучению языков программирования - Заявка на обучение</title>
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
