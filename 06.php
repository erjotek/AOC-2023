<?php

function input($input)
{
    $input = explode("\n", $input);
    $input = array_map(null, ...array_map(fn($l) => preg_split('/\s+/', trim(explode(':', $l)[1])), $input));

    return $input;
}

function part1($input)
{
    return array_product(array_map(fn($x) => mul($x[0], $x[1]), $input)); //505494
}

function part2($input)
{
    $b = implode('', array_column($input, '0'));
    $c = implode('', array_column($input, '1'));

    return mul($b, $c); //23632299
}

function mul($b, $c)
{
    $delta = $b ** 2 - 4 * $c;
    $x1 = floor(($b - sqrt($delta)) / 2 + 1);
    $x2 = ceil(($b + sqrt($delta)) / 2 - 1);
    return $x2 - $x1 + 1;
}

include __DIR__ . '/template.php';
