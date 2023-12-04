<?php

function input($input)
{
    $cards = [];
    $input = explode("\n", $input);
    foreach ($input as $id => $card) {
        $card = explode(":", $card);
        [$win, $num] = explode(" | ", $card[1]);

        $win = array_map('intval', str_split($win, 3));
        $num = array_map('intval', str_split($num, 3));

        $cards[$id + 1] = [$win, $num];
    }

    return $cards;
}

function part1($input)
{
    $sum = 0;
    foreach ($input as $card) {
        $count = count(array_intersect($card[0], $card[1]));
        if ($count) {
            $sum += 2 ** ($count - 1);
        }
    }

    return $sum; //20829
}

function part2($input)
{
    $mul = [];
    foreach ($input as $id => $card) {
        $mul[$id] ??= 0;
        $copies = 1 + $mul[$id];

        $count = count(array_intersect($card[0], $card[1]));

        if ($count) {
            for ($i = $id + 1; $i <= $id + $count; $i++) {
                $mul[$i] ??= 0;
                $mul[$i] += $copies;
            }
        }
        $mul[$id]++;
    }

    return array_sum($mul); //12648035
}

include __DIR__ . '/template.php';
