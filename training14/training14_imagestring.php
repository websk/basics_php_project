<?php
$image = imagecreate(300, 50);
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);

$font = imageloadfont('04b.gdf');
imagestring($image, $font, 50, 18, "Hello world", $black);

header("Content-Type: image/png");
imagepng($image);
