<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(PHP_EOL, $inputString);

$combinations = [];

sort($inputArray);

function tribonacci($n) {
    switch ($n) {
        case 0:
        case 1: return 0;
        case 2: return 1;
        default: return tribonacci($n - 1)
            + tribonacci($n - 2)
            + tribonacci($n - 3);
    }
}

for ($i = 0; $i < count($inputArray);) {
    $start = $i;
    $end = $i;

    while (($end + 1) < count($inputArray) && $inputArray[$end] + 1 == $inputArray[$end + 1]) {
        $end++;
    }

    $adapters = array_slice($inputArray, $start, $end - $start + 1);
    if (!$i) {
        array_unshift($adapters, 0);
    }

    $amount = count($adapters);
    if ($amount < 3) {
        $i++;
        continue;
    }

    $combinations[] = tribonacci(++$amount);

    $i = $end + 1;
}

echo array_product($combinations) . PHP_EOL;

// x = 1
// 2 - 0 = 2
// 0 1 2

// x = 2
// 4 - 0 = 4
// 0 1 2 3

// x = 3
// 8 - 1 = 7
// 0 1 2 3 4
// 0       4

// x = 4
// 16 - 3 = 13
// 0 1 2 3 4 5
// 0         5
// 0 1       5
// 0       4 5

// x = 5
// 32 - 8 = 24
// 0 1 2 3 4 5 6
// 0           6
// 0 1         6
// 0   2       6
// 0 1 2       6
// 0         5 6
// 0       4   6
// 0       4 5 6
// 0 1       5 6
