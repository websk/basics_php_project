<?php

const RUBLES_PER_DOLLAR = 91;

function calculate_rubles(int $dollars_count): int
{
    return $dollars_count * RUBLES_PER_DOLLAR;
}
