<?php
$image = imagecreate(300, 300);
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
imagefilledrectangle($image, 50, 50, 250, 250, $black);
header("Content-Type: image/png");
imagepng($image);
