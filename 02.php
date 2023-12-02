<?php

function input($input)
{
    $input = explode("\n", $input);
    $games = [];

    foreach ($input as $line) {
        preg_match('/Game (\d+): (.*)/', $line, $ret);
        $g = explode(";", $ret[2]);
        foreach ($g as $k => $v) {
            preg_match_all('/(\d+) (\w+)/', $v, $gg, PREG_SET_ORDER);
            foreach ($gg as $colors) {
                $games[$ret[1]][$k][$colors[2]] = $colors[1];
            }
        }
    }

    return $games;
}

function part1($input)
{
    return array_sum(
        array_keys(
            array_filter(
                $input,
                fn($game) => max(array_column($game, 'red')) <= 12
                    && max(array_column($game, 'green')) <= 13
                    && max(array_column($game, 'blue')) <= 14
            )
        )
    ); // 2256
}

function part2($input)
{
    return array_sum(
        array_map(
            fn($game) => max(array_column($game, 'red'))
                * max(array_column($game, 'blue'))
                * max(array_column($game, 'green'))
            , $input
        )
    ); // 74229
}

include __DIR__ . '/template.php';
