<?php

$inputString = require 'input.php';

$inputArray = explode(PHP_EOL, $inputString);

$combinations = [];

sort($inputArray);

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
    $diff = $amount - 2;
    if ($diff < 1) {
        $i++;
        continue;
    }

    if ($diff == 1) $possibilities = 2;
    elseif ($diff == 2) $possibilities = 4;
    elseif ($diff == 3) $possibilities = 7;
    elseif ($diff == 4) $possibilities = 13;
    elseif ($diff == 5) $possibilities = 24;

    $combinations[] = $possibilities;

    $i = $end + 1;
}

echo array_product($combinations) . PHP_EOL;

// x = 1
// 2 - 0
// 0 1 2

// x = 2
// 4 - 0
// 0 1 2 3

// x = 3
// 8 - 1
// 0 1 2 3 4
// 0       4

// x = 4
// 16 - 3
// 0 1 2 3 4 5
// 0         5
// 0 1       5
// 0       4 5

// x = 5
// 32 - 8
// 0 1 2 3 4 5 6
// 0           6
// 0 1         6
// 0   2       6
// 0 1 2       6
// 0         5 6
// 0       4   6
// 0       4 5 6
// 0 1       5 6
