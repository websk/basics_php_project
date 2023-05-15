<?php
$image = imagecreatefrompng('training14_elephant.png');

header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);