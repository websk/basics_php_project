<?php
const CAPTCHA_COOKIE_NAME = 'captcha';

const FONTS_PATH = __DIR__ . '/fonts';

const FONTS_ARR = [
    FONTS_PATH . '/font1.ttf',
    FONTS_PATH . '/font2.ttf'
];

const FONT_SIZE = 16;

const SYMBOLS_NUM = 5;

const CAPTCHA_WIDTH = 150;

const CAPTCHA_HEIGHT = 40;

const LETTERS = ['1', '2', '3', '4', '5', '6', '7', '8', '9'];

const COLORS_ARR = [50, 100, 70, 110, 130, 150, 170, 210, 230, 10];

const ANGLE_START = 5;

const ANGLE_END = 20;

const NUMBER_OF_BACKGROUND_SIGNS = 50;

const ALPHA_START = 20;

const ALPHA_END = 70;


$image = imagecreatetruecolor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT);

$white = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $white);


// Рисуем фоновый шум

for ($i = 0; $i < NUMBER_OF_BACKGROUND_SIGNS; $i++) {
    $color = imagecolorallocatealpha($image, 200, 200, 200, 90);

    $random_size = mt_rand(FONT_SIZE - 3, FONT_SIZE);

    $back_random_x = mt_rand(CAPTCHA_WIDTH * 0.1, CAPTCHA_WIDTH - 5);
    $back_random_y = mt_rand(CAPTCHA_HEIGHT * 0.2, CAPTCHA_HEIGHT - 5);

    $random_angle = mt_rand(ANGLE_START, ANGLE_END);
    $random_font = FONTS_ARR[mt_rand(0, count(FONTS_ARR) - 1)];
    $random_letter = LETTERS[mt_rand(0, count(LETTERS) - 1)];

    imagettftext($image, $random_size, $random_angle, $back_random_x, $back_random_y, $color, $random_font, $random_letter);
}

// Выводим основное изображение

$captcha_cookie_arr = [];

for ($i = 0; $i < SYMBOLS_NUM; $i++) {
    $random_size = mt_rand(FONT_SIZE, FONT_SIZE * 2);

    $random_angle = mt_rand(ANGLE_START, ANGLE_END);

    if (!isset($random_x)) {
        $random_x = CAPTCHA_WIDTH * 0.08;
    } else {
        $random_x = $random_x + (CAPTCHA_WIDTH * 0.8) / SYMBOLS_NUM + mt_rand(0, CAPTCHA_WIDTH * 0.01);
    }

    if (mt_rand(1, 2) == 1) {
        $random_y = CAPTCHA_HEIGHT * 1.15 * 3 / 4 + mt_rand(0, CAPTCHA_HEIGHT * 0.02);
    } else {
        $random_y = CAPTCHA_HEIGHT * 1.15 * 3 / 4 - mt_rand(0, CAPTCHA_HEIGHT * 0.02);
    }

    $random_color = imagecolorallocatealpha(
        $image,
        COLORS_ARR[mt_rand(0, count(COLORS_ARR) - 1)],
        COLORS_ARR[mt_rand(0, count(COLORS_ARR) - 1)],
        COLORS_ARR[mt_rand(0, count(COLORS_ARR) - 1)],
        mt_rand(ALPHA_START, ALPHA_END)
    );

    $random_font = FONTS_ARR[mt_rand(0, count(FONTS_ARR) - 1)];

    $random_letter = mb_strtolower(LETTERS[mt_rand(0, count(LETTERS) - 1)]);

    imagettftext($image, $random_size, $random_angle, $random_x, $random_y, $random_color, $random_font, $random_letter);

    $captcha_cookie_arr[] = $random_letter;
}

$captcha_cookie = implode('', $captcha_cookie_arr);
setcookie(CAPTCHA_COOKIE_NAME, $captcha_cookie, 0, '/');

header('Content-type: image/png');

imagepng($image);
imagedestroy($image);