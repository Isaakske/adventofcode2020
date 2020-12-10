<?php

$inputString = require 'input.php';

$inputArray = explode(PHP_EOL, $inputString);

$jolt = 0;

sort($inputArray);

foreach ($inputArray as $i => $input) {
    if ($i === count($inputArray) - 1) {
        break;
    }

    $previous = !$i ? 0 : $inputArray[$i - 1];
    $next = $inputArray[$i + 1];

    if ($input - $previous == 1 && $next - $input == 1) $jolt++;
}

echo pow(2, $jolt) . PHP_EOL;
