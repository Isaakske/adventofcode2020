<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(PHP_EOL, $inputString);

$valid = 0;

foreach ($inputArray as $i) {
    preg_match('/(\d*)-(\d*)\s([a-z]):\s([a-z]*)/', $i, $matches);

    $min = $matches[1];
    $max = $matches[2];
    $char = $matches[3];
    $pwd = $matches[4];

    $count = 0;

    foreach ([$min, $max] as $index) {
        if ($pwd[$index - 1] == $char) {
            $count++;
        }
    }

    if ($count == 1) {
        $valid++;
    }
}

echo $valid . PHP_EOL;
