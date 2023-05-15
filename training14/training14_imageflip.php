<?php
$image = imagecreatefrompng('training14_elephant.png');

imageflip($image, IMG_FLIP_VERTICAL);

header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
