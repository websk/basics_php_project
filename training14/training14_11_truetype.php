<?php
$image = imagecreate(300, 50);
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);

$fontname = '../fonts/font1.ttf';

imagettftext($image, 20, 0, 60, 33, $black, $fontname, "Привет мир");

header("Content-Type: image/png");
imagepng($image);
