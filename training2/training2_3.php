<?php
$a = [
    0 => 1,
    1 => 2,
    2 => 3
];

$a = array();
$a = [];
$a[0] = 1;
$a[1] = 2;
$a[2] = 3;

print_r($a);

?>

<?php
$user_arr = [
    'firstname' => 'Иван',
    'surname' => 'Петров',
    'age' => 25
];

print_r($user_arr);

echo $user_arr['name'] . ' Petrov';
?>

<?php
$user_std_obj = new stdClass();
$user_std_obj->name = 'Иван';
$user_std_obj->surname = 'Петров';

print_r($user_std_obj);

echo $user_std_obj->surname;
?>


