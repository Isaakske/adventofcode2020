<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(PHP_EOL, $inputString);

function applyMask($value, $mask) {
    $value = array_reverse(str_split(str_pad($value, 36, "0", STR_PAD_LEFT)));
    $mask = array_reverse(str_split($mask));

    foreach ($mask as $i => $x) {
        if ($x != 'X') {
            $value[$i] = $x;
        }
    }

    return implode('', array_reverse($value));
}

$memory = [];
$mask = '';
foreach ($inputArray as $i => $input) {
    preg_match('/mask = ([01X]+)/', $input, $maskMatch);
    if ($maskMatch) {
        $mask = $maskMatch[1];
        continue;
    }

    preg_match('/mem\[(\d+)] = (\d+)/', $input, $match);
    $address = $match[1];
    $value = $match[2];

    $value = bindec(applyMask(decbin($value), $mask));
    $memory[$address] = $value;
}

echo array_sum($memory) . PHP_EOL;
