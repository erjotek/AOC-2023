<?php

function input($input)
{
    return explode("\n", $input);
}

function part1($input)
{
    $sum = 0;
    foreach ($input as $line) {
        $line = preg_replace("/[^1-9]/", "", $line);
        $sum += (int)($line[0].$line[-1]);
    }

    return $sum; //53651
}

function part2($input)
{
    $sum = 0;
    foreach ($input as $line) {
        $linel = strtr($line, ['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5, 'six' => 6, 'seven' => 7, 'eight' => 8, 'nine' =>9]);
        preg_match('/(\d)/', $linel, $l);

        $liner = strrev($line);
        $liner = strtr($liner, ['eno' => 1, 'owt' => 2, 'eerht' => 3, 'ruof' => 4, 'evif' => 5, 'xis' => 6, 'neves' => 7, 'thgie' => 8, 'enin' =>9]);
        preg_match('/(\d)/', $liner, $r);

        $sum += (int)($l[1].$r[1]);
    }

    return $sum; //53894
}

include __DIR__ . '/template.php';
