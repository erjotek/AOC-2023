<?php

function input($input)
{
    return explode("\n", $input);
}

function part1($input)
{
    $symbols = [];
    $numbers = [];
    foreach ($input as $row => $line) {
        preg_match_all("/\d+/", $line, $nums, PREG_OFFSET_CAPTURE);
        preg_match_all("/[^\d.]/", $line, $syms, PREG_OFFSET_CAPTURE);

        foreach ($nums[0] ?? [] as [$num, $col]) {
            $numbers[] = [$num, $row, $col];
        }

        foreach ($syms[0] ?? [] as [$sym, $col]) {
            $symbols[$row][$col - 1] = $sym;
            $symbols[$row][$col + 1] = $sym;
            $symbols[$row - 1][$col] = $sym;
            $symbols[$row + 1][$col] = $sym;
            $symbols[$row - 1][$col - 1] = $sym;
            $symbols[$row - 1][$col + 1] = $sym;
            $symbols[$row + 1][$col - 1] = $sym;
            $symbols[$row + 1][$col + 1] = $sym;
        }
    }

    $sum = 0;
    foreach ($numbers as $num) {
        for ($i = $num[2]; $i < $num[2] + strlen($num[0]); $i++) {
            if (isset($symbols[$num[1]][$i])) {
                $sum += $num[0];
                continue 2;
            }
        }
    }

    return $sum; //540212;
}

function part2($input)
{
    $symbols = [];
    $numbers = [];
    foreach ($input as $row => $line) {
        preg_match_all("/\d+/", $line, $nums, PREG_OFFSET_CAPTURE);
        preg_match_all("/\*/", $line, $syms, PREG_OFFSET_CAPTURE);

        foreach ($nums[0] ?? [] as [$num, $col]) {
            for ($i = $col; $i < $col + strlen($num); $i++) {
                $numbers[$row][$i] = "$num-$row-$col";
            }
        }

        foreach ($syms[0] ?? [] as [$sym, $col]) {
            $symbols[] = [$row, $col];
        }
    }

    $sum = 0;
    foreach ($symbols as [$row, $col]) {
        $gears = [];

        $pos = [
            [$row, $col - 1],
            [$row, $col + 1],
            [$row - 1, $col],
            [$row + 1, $col],
            [$row - 1, $col + 1],
            [$row - 1, $col - 1],
            [$row + 1, $col + 1],
            [$row + 1, $col - 1],
        ];

        foreach ($pos as [$nrow, $ncol]) {
            if (isset($numbers[$nrow][$ncol])) {
                $gears[$numbers[$nrow][$ncol]] = explode('-', $numbers[$nrow][$ncol])[0];
            }
        }

        if (count($gears) === 2) {
            $sum += array_product($gears);
        }
    }

    return $sum; //87605697
}

include __DIR__ . '/template.php';
