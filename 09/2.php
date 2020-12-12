<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(PHP_EOL, $inputString);

$expected = 530627549;

foreach ($inputArray as $i => $input) {
    $set = [$input];

    while (array_sum($set) < $expected) {
        $set[] = $inputArray[++$i];
    }

    if (array_sum($set) == $expected) {
        echo min($set) + max($set) . PHP_EOL;
    }
}
