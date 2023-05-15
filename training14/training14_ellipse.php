<?php
$size = 200;

$image = imagecreatetruecolor($size, $size);
$white = imagecolorallocate($image, 255, 255, 255);

imagefilledrectangle($image, 0, 0, $size, $size, $white);

$black = imagecolorallocate($image, 0, 0, 0);

imagefilledellipse($image, $size / 2, $size / 2, $size - 10, $size - 10, $black);

header('content-type: image/png');
imagepng($image);
imagedestroy($image);