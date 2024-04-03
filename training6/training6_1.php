<?php

$url = "https://login:passw@my_site.net:445/path/to/page.php?param1=value1#anchors1";

$url_arr = parse_url($url);

foreach ($url_arr as $key => $value) {
    echo $key . ': ' . $value . PHP_EOL;
}