<?php
$size = 200;
$image = imagecreatetruecolor($size, $size);
$white = imagecolorallocate($image, 255, 255, 255);

imagefilledrectangle($image, 0, 0, $size - 1, $size - 1, $white);
// три точки прямоугольного треугольника
$x1 = 10;
$y1 = 10;
$x2 = $y2 = $size - 10;
$x3 = 10;
$y3 = $size - 10;

$black = imagecolorallocate($image, 0, 0, 0);
$points = array($x1, $y1, $x2, $y2, $x3, $y3);

imagepolygon($image, $points, count($points) / 2, $black);

header('content-type: image/png');
imagepng($image);
imagedestroy($image);