<?php

function input($input)
{
    [$ins, $lines] = explode("\n\n", $input);

    $ins = str_split(str_replace(['L', 'R'], ['0', '1'], $ins));

    $nodes = [];
    foreach (explode("\n", $lines) as $line) {
        preg_match('~(\w+) = \((\w+), (\w+)\)~', $line, $r);
        $nodes[$r[1]] = [$r[2], $r[3]];
    }

    return [$ins, $nodes];
}

function part1($input)
{
    [$ins, $nodes] = $input;

    $step = 0;
    $next = $nodes['AAA'][$ins[0]];

    while ($next !== 'ZZZ') {
        $step++;
        $next =  $nodes[$next][$ins[$step % count($ins)]];
    }

    return $step + 1; //11567
}

function part2($input)
{

    [$ins, $nodes] = $input;
    $starts = array_values(array_filter(array_keys($nodes), fn($n) => str_ends_with($n, 'A')));

    $steps = [];
    foreach ($starts as $k => $next) {
        $step = 0;
        while (true) {
            $next = $nodes[$next][$ins[$step++ % count($ins)]];
            if ($next[2] === 'Z') {
                $steps[$k] = $step;
                break;

            }
        }
    }

    $lcm = 1;
    foreach ($steps as $step) {
        $lcm = lcm($lcm, $step);
    }

    return $lcm; // 9858474970153

}


function lcm($a, $b)
{
    if (is_int($a) && is_int($b) && $a > 0) {
        $ab = $a * $b;

        while ($b) {
            $c = $b;
            $b = $a % $b;
            $a = $c;
        }

        return $ab /= $a;
    }
    return false;
}


include __DIR__ . '/template.php';