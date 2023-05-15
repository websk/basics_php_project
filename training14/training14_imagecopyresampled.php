<?php
$image = imagecreatefrompng('training14_elephant.png');

$width = imagesx($image);
$height = imagesy($image);

$x = $width / 2;
$y = $height / 2;

$destination = imagecreatetruecolor($x, $y);
imagecopyresampled($destination, $image, 0, 0, 0, 0, $x, $y, $width, $height);

header('Content-Type: image/png');
imagepng($destination);
imagedestroy($destination);
