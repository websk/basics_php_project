$<?php
$image = imagecreatefrompng('training14_2_elephant.png');

header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);