<?php

$inputString = require 'input.php';

$inputArray = explode(PHP_EOL, $inputString);

$acc = 0;
$i = 0;
$history = [];

do {
    $history[] = $i;

    preg_match('/([a-z]{3}) ([-|+]\d+)/', $inputArray[$i], $instruction);

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
} while (!in_array($i, $history));

echo $acc . PHP_EOL;
