<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(PHP_EOL, $inputString);

$jolt1 = 0;
$jolt3 = 1;

sort($inputArray);

foreach ($inputArray as $i => $input) {
    $previous = !$i ? 0 : $inputArray[$i - 1];

    if ($input - $previous == 1) $jolt1++;
    if ($input - $previous == 3) $jolt3++;
}

echo $jolt1 * $jolt3 . PHP_EOL;
