<?php
$image = imagecreatefrompng('training14_2_elephant.png');

$width = imagesx($image);
$height = imagesy($image);

$crop_width = $width / 2;
$crop_height = $height / 2;

$crop_image = imagecrop($image, ['x' => 0, 'y' => 0, 'width' => $crop_width, 'height' => $crop_height]);

header('Content-Type: image/png');
imagepng($crop_image);
imagedestroy($crop_image);
