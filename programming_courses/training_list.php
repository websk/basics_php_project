<?php
require "programming_courses_repository.php";

function request_for_training_list(int $programming_language_id,int $learning_time_id)
{
    $request_for_training_rows = get_request_for_training_rows($programming_language_id, $learning_time_id);
    ?>
    <table style="border: 1px solid; border-color: #aaaaaa;">
        <thead>
        <tr>
            <th style="border: 1px solid; border-color: #aaaaaa; width: 100px;">Фото</th>
            <th style="border: 1px solid; border-color: #aaaaaa; width: 300px;">Обучающийся</th>
            <th style="border: 1px solid; border-color: #aaaaaa; width: 200px;">Образование</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($request_for_training_rows as $request_for_training_row) {
            $user_photo_img_str = '';
            if ($request_for_training_row['user_photo']) {
                $user_photo_img_str = '<img src="/photo/' . $request_for_training_row['user_photo'] . '" width="100">';
            }

            ?>
            <tr>
                <td style="border: 1px solid; border-color: #aaaaaa;"><?php echo $user_photo_img_str; ?></td>
                <td style="border: 1px solid; border-color: #aaaaaa;"><?php echo $request_for_training_row['username']; ?></td>
                <td style="border: 1px solid; border-color: #aaaaaa;"><?php echo $request_for_training_row['education_title']; ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}
?>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Курсы по изучению языков программирования - Список обучающихся</title>
</head>
<body>

<h1>Список обучающихся</h1>

<?php
$programming_languages_arr = get_programming_languages_arr();
$learning_times_arr = get_learning_times_arr();

foreach ($programming_languages_arr as $programming_language_row) {
    echo '<h2>' . $programming_language_row['language_name'] . '</h2>';

    foreach ($learning_times_arr as $learning_time_row) {
        echo '<h3>' . $learning_time_row['title'] . '</h3>';

        request_for_training_list($programming_language_row['id'], $learning_time_row['id']);
    }
}
?>

<p>
    <a href="/training_form.php">Отправить заявку</a>
    / <a href="/logout.php">Выход</a>
</p>
</body>
</html>
