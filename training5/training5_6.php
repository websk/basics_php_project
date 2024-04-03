<?php

$n = 0;
for ($i = 1; $i <= 10; $i++) {
    if ($i % 2) {
        continue;
    }

    $n = $n + $i;
}

echo $n;