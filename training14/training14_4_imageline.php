<?php
$width = 300;
$height = 100;

$image = imagecreatetruecolor($width, $height);

$white = imagecolorallocate($image, 255, 255, 255);
imagefilledrectangle($image, 0, 0, $width, $height, $white);

$x1 = 0;
$y1 = $height / 2;
$x2 = $width;
$y2 = $height / 2;
$black = imagecolorallocate($image, 0, 0, 0);

imageline($image, $x1, $y1, $x2, $y2, $black);

header('Content-type: image/png');

imagepng($image);
imagedestroy($image);