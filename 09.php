<?php

function input($input)
{
    $input = explode("\n", $input);

    return $input;
}

function part1($input)
{
    $sum = 0;
    foreach ($input as $line) {
        $next = find_next($line);
        $sum += $next;
    }

    return $sum; // 2075724761
}

function part2($input)
{
    $sum = 0;
    foreach ($input as $line) {
        $next = find_next($line, true);
        $sum += $next;
    }

    return $sum; //1072
}

function find_next($line, $second = false)
{
    $line = explode(" ", $line);

    if ($second) {
        $line = array_reverse($line);
    }

    $new = 0;

    while (implode('', $line) != 0) {
        $newline = [];
        foreach ($line as $i => $v) {
            if (isset($line[$i + 1])) {
                $newline[] = $line[$i + 1] - $v;
            } else {
                $new += $v;
            }
        }
        $line = $newline;
    }

    return $new;
}

include __DIR__ . '/template.php';