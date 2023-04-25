<?php
require "sanitize.php";
require "mysqli.php";

const EDUCATION_SCHOOL = 'school';

const PROGRAMMING_LANGUAGE_PHP = 'php';

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
            <select name="time_for_learning">
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

    $education_short_name = array_key_exists('education', $_POST) ? $_POST['education'] : '';
    $filtered_education_short_name = filter_string($education_short_name);

    $short_languages_names_arr = array_key_exists('languages', $_POST) ? $_POST['languages'] : [];
    $filtered_short_languages_names_arr = [];

    foreach ($short_languages_names_arr as $short_language) {
        $filtered_short_language = filter_string($short_language);

        if (!$filtered_short_language) {
            continue;
        }

        $filtered_short_languages_names_arr[] = $filtered_short_language;
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

    if (!get_education_id_by_short_name($filtered_education_short_name)) {
        $errors_arr[] = 'Вы не заполнили образование';
    }

    if (!$filtered_short_languages_names_arr) {
        $errors_arr[] = 'Вы не выбрали ни один язык программирования';
    }

    if (count($short_languages_names_arr) != count($filtered_short_languages_names_arr)) {
        $errors_arr[] = 'Вы не корректно указали языки программирования';
    }

    if (!get_learning_time_id_by_short_name($filtered_time_for_learning)) {
        $errors_arr[] = 'Вы не выбрали время для обучения';
    }

    $content_html = '';

    if ($errors_arr) {
        $content_html .= '<p>';
        $content_html .= implode('<br>', $errors_arr);
        $content_html .= '</p>';

        return $content_html;
    }

    foreach ($filtered_short_languages_names_arr as $filtered_short_language) {
        $request_id = add_request_for_training_to_db(
            $filtered_username,
            $filtered_about_me,
            $filtered_short_language,
            $filtered_email,
            $filtered_education_short_name,
            $filtered_time_for_learning
        );
        if ($request_id === false) {
            continue;
        }

        $content_html .= '<h2>' . $filtered_username . ', Ваша заявка ' . $request_id . ' принята, спасибо!</h2>';
    }

    return $content_html;
}

function add_request_for_training_to_db(
    string $username,
    string $about_me,
    string $short_language_name,
    string $email,
    string $education_short_name,
    string $learning_time_short_name
): bool|int
{
    $programming_language_id = get_programming_language_id_by_short_language_name($short_language_name);
    if (!$programming_language_id) {
        return false;
    }

    $education_id = get_education_id_by_short_name($education_short_name);
    if (!$education_id) {
        return false;
    }

    $learning_time_id = get_learning_time_id_by_short_name($learning_time_short_name);
    if (!$learning_time_id) {
        return false;
    }

    $mysqli = db_connect();
    $query = "INSERT INTO request_for_training SET username = ?, about_me = ?, programming_language_id = ?, email = ?, education_id = ?, learning_time_id = ?";
    $statement = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($statement, 'ssisii', ...[$username, $about_me, $programming_language_id, $email, $education_id, $learning_time_id]);
    mysqli_stmt_execute($statement);

    $request_id = mysqli_insert_id($mysqli);

    return $request_id;
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
?>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Курсы по изучению языков программирования - Заявка</title>
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
