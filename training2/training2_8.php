<?php
// Локальная область видимости

function updateCounter()
{
    $counter = 20;
    $counter++;

    echo $counter;
}

$counter = 10;

updateCounter();
?>

<?php
// Глобальная область видимости

function updateCounter()
{
    global $counter;

    if (!isset($counter)) {
        $counter = 20;
    };
    $counter++;

    echo $counter;
}

$counter = 10;
updateCounter();
?>
<?php
// global использовать не рекомендуется, правильно передавать значение через параметры функции

function updateCounter($counter)
{
    if (!isset($counter)) {
        $counter = 20;
    };
    $counter++;

    echo $counter;
}

$counter = 10;

updateCounter($counter);
?>

<?php
// Статические переменные

function updateCounter()
{
    static $counter;

    if (isset($counter)) {
        return $counter . PHP_EOL;
    };

    $counter = 20;
    return;
}

echo updateCounter();
echo 'ОГО ' . updateCounter();
echo updateCounter();

