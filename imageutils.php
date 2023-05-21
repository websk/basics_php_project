<?php
/**
 * @param string $src - имя исходного файла
 * @param string $dest - имя генерируемого файла
 * @param int $resize_value
 * @param int $quality - качество генерируемого изображения
 * @param bool $to_width -  обрезать по ширине или высоте
 * @return bool
 */
function resize_image(string $src, string $dest, int $resize_value, int $quality, bool $to_width = true): bool
{
    if (!file_exists($src)) {
        return false;
    }

    $size = getimagesize($src);
    if ($size === false) {
        return false;
    }

    $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
    $icfunc = "imagecreatefrom" . $format;

    if ($format == 'png') {
        $quality = ceil($quality/10);
    }

    if (!function_exists($icfunc)) {
        return false;
    }

    if ($to_width) {
        $width = $resize_value;
        $ratio = $size[0] / $width;
        $height = round($size[1] / $ratio);
    } else {
        $height = $resize_value;
        $ratio = $size[1] / $height;
        $width = round($size[0] / $ratio);
    }

    $rgb = 0xFFFFFF;

    $isrc = $icfunc($src);
    $idest = imagecreatetruecolor($width, $height);
    // $rgb - цвет фона, по умолчанию - белый
    imagefill($idest, 0, 0, $rgb);

    imagecopyresampled($idest, $isrc, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);

    $formatfunc = 'image' . $format;
    $formatfunc($idest, $dest, $quality);

    imagedestroy($isrc);
    imagedestroy($idest);

    return true;
}