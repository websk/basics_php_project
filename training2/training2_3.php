<?php
// Массивы
$arr = [
    0 => 1,
    1 => 2,
    2 => 3
];

$arr = array();
$arr = [];
$arr[0] = 1;
$arr[1] = 2;
$arr[2] = 3;

print_r($arr);

?>

<?php
// Ассоциативный массив
$user_arr = [
    'firstname' => 'Иван',
    'surname' => 'Петров',
    'age' => 25
];

print_r($user_arr);

echo $user_arr['name'] . ' Petrov';
?>

<?php
// Объекты
$user_std_obj = new stdClass();
$user_std_obj->name = 'Иван';
$user_std_obj->surname = 'Петров';

print_r($user_std_obj);

echo $user_std_obj->surname;
?>


