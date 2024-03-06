<?php
// Инструкция return

function my_function($a)
{
    if ($a == 3) {
        $a--;
        return $a;
    }

    return 1;
}

echo my_function(3);
