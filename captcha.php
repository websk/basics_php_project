<?php

const CAPTCHA_COOKIE_NAME = 'kvaYtnctkHqzTxR2b3Mi';

const FONTS_PATH = __DIR__ . '/fonts/'; // Путь к шрифтам

const FONTS_ARR = [
    FONTS_PATH . 'font1.ttf',
    FONTS_PATH . 'font2.ttf'
];

const FONT_SIZE = 14;

const SYMBOLS_NUM = 5;

const CAPTCHA_WIDTH = 140; // Ширина изображения

const CAPTCHA_HEIGHT = 40; // Высота изображения

const LETTERS = ['1', '2', '3', '4', '5', '6', '7', '8', '9'];

const FIGURES_ARR = ['50', '70', '90', '110', '130', '150', '170', '190', '210'];


$_COOKIE[CAPTCHA_COOKIE_NAME] = '';

$number_of_signs = intval((CAPTCHA_WIDTH * CAPTCHA_HEIGHT) / 150);

$code = [];

$src = imagecreatetruecolor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT);

$fon = imagecolorallocate($src, 255, 255, 255);
imagefill($src, 0, 0, $fon);

// Рисуем фоновый "шум"

for ($i = 0; $i < $number_of_signs; $i++) {
    $h = 1;

    $color = imagecolorallocatealpha($src, rand(200, 200), rand(200, 200), rand(200, 200), 100);
    $font = FONTS_ARR[rand(0, count(FONTS_ARR) - 1)];
    $letter = mb_strtolower(LETTERS[rand(0, count(LETTERS) - 1)]);
    $size = rand(FONT_SIZE - 1, FONT_SIZE + 1);
    $angle = rand(0, 60);

    if ($h == rand(1, 2)) {
        $angle = rand(360, 300);
    }

    imagettftext($src, $size, $angle, rand(CAPTCHA_WIDTH * 0.1, CAPTCHA_WIDTH - 20), rand(CAPTCHA_HEIGHT * 0.2, CAPTCHA_HEIGHT - 10), $color, $font, $letter);
}

// Выводим основные символы

for ($i = 0; $i < SYMBOLS_NUM; $i++) {
    $h = 1; // Ориентир

    $color = imagecolorallocatealpha(
        $src,
        FIGURES_ARR[rand(0, count(FIGURES_ARR) - 1)],
        FIGURES_ARR[rand(0, count(FIGURES_ARR) - 1)],
        FIGURES_ARR[rand(0, count(FIGURES_ARR) - 1)],
        rand(10, 30)
    );
    $font = FONTS_ARR[rand(0, count(FONTS_ARR) - 1)];
    $letter = mb_strtolower(LETTERS[rand(0, count(LETTERS) - 1)]);
    $size = rand(FONT_SIZE * 2.1 - 1, FONT_SIZE * 2.1 + 1);
    $x = (empty($x)) ? CAPTCHA_WIDTH * 0.08 : $x + (CAPTCHA_WIDTH * 0.8) / SYMBOLS_NUM + rand(0, CAPTCHA_WIDTH * 0.01);

    if ($h == rand(1, 2)) {
        $y = ((CAPTCHA_HEIGHT * 1.15 * 3) / 4) + rand(0, CAPTCHA_HEIGHT * 0.02);
    } else {
        $y = ((CAPTCHA_HEIGHT * 1.15 * 3) / 4) - rand(0, CAPTCHA_HEIGHT * 0.02);
    }

    $angle = rand(5, 20);

    $code[] = $letter;

    if ($h == rand(1, 2)) {
        $angle = rand(355, 340);
    }

    imagettftext($src, $size, $angle, $x, $y, $color, $font, $letter);
}

$captcha = mb_strtolower(implode('', $code));

setcookie(CAPTCHA_COOKIE_NAME, $captcha, 0, '/');

header('Content-type: image/png');

imagepng($src);
imagedestroy($src);