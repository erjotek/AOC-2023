<?php

function input($input)
{
    $input = explode("\n", $input);
    $input = array_map(fn($l) => explode(' ', $l), $input);
    $input = array_column($input, '1', '0');

    return $input;
}

function part1($input)
{
    uksort($input, 'sorter');

    $sum = 0;
    $mul = 1;
    foreach ($input as $i) {
        $sum += $i * $mul;
        $mul++;
    }
    return $sum; //247823654
}

function part2($input)
{
    uksort($input, 'sorter2');

    $sum = 0;
    $mul = 1;
    foreach ($input as $i) {
        $sum += $i * $mul;
        $mul++;
    }
    return $sum; // 245461700
}

function sorter($a, $b)
{
    $aa = array_count_values(str_split($a));
    $bb = array_count_values(str_split($b));

    rsort($aa);
    rsort($bb);

    if (($aa[0] ?? 0) > ($bb[0] ?? 0)) {
        return 1;
    }

    if (($aa[0] ?? 0) < ($bb[0] ?? 0)) {
        return -1;
    }

    if (($aa[1] ?? 0) > ($bb[1] ?? 0)) {
        return 1;
    }

    if (($aa[1] ?? 0) < ($bb[1] ?? 0)) {
        return -1;
    }

    $a = str_replace(['A', 'K', 'Q', 'J', 'T'], ['Z', 'Y', 'X', 'W', 'U'], $a);
    $b = str_replace(['A', 'K', 'Q', 'J', 'T'], ['Z', 'Y', 'X', 'W', 'U'], $b);

    return strcmp($a, $b);
}

function sorter2($a, $b)
{
    $aa = array_count_values(str_split($a));
    $bb = array_count_values(str_split($b));


    $aj = $aa['J'] ?? 0;
    $bj = $bb['J'] ?? 0;

    unset($aa['J']);
    unset($bb['J']);

    arsort($aa);
    arsort($bb);

    $aa = array_values($aa);
    $bb = array_values($bb);
    $aa[0] ??= 0;
    $bb[0] ??= 0;
    $aa[0] += $aj;
    $bb[0] += $bj;

    if (($aa[0] ?? 0) > ($bb[0] ?? 0)) {
        return 1;
    }

    if (($aa[0] ?? 0) < ($bb[0] ?? 0)) {
        return -1;
    }

    if (($aa[1] ?? 0) > ($bb[1] ?? 0)) {
        return 1;
    }

    if (($aa[1] ?? 0) < ($bb[1] ?? 0)) {
        return -1;
    }

    $a = str_replace(['A', 'K', 'Q', 'J', 'T'], ['Z', 'Y', 'X', '1', 'U'], $a);
    $b = str_replace(['A', 'K', 'Q', 'J', 'T'], ['Z', 'Y', 'X', '1', 'U'], $b);

    return strcmp($a, $b);
}

include __DIR__ . '/template.php';