<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(PHP_EOL, $inputString);

$inputArrays = [];
foreach ($inputArray as $x => $y) {
    preg_match('/([a-z]{3}) ([-|+]\d+)/', $y, $instruction);

    $operation = $instruction[1];
    $amount = $instruction[2];

    if ($operation === 'acc') continue;

    if ($operation === 'jmp') $operation = 'nop';
    elseif ($operation === 'nop') $operation = 'jmp';

    $copy = $inputArray;
    $copy[$x] = $operation . ' ' . $amount;

    $inputArrays[] = $copy;
}

foreach ($inputArrays as $input) {
    $acc = 0;
    $i = 0;
    $history = [];

    do {
        $history[] = $i;

        preg_match('/([a-z]{3}) ([-|+]\d+)/', $input[$i], $instruction);

        $operation = $instruction[1];
        $amount = (int) $instruction[2];

        if ($operation === 'acc') {
            $acc += $amount;
            $i++;
        } elseif ($operation === 'jmp') {
            $i += $amount;
        } elseif ($operation === 'nop') {
            $i++;
        }
    } while (!in_array($i, $history) && array_key_exists($i, $input));

    if ($i == count($inputArray)) {
        echo $acc . PHP_EOL;
    }
}
