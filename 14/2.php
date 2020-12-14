<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(PHP_EOL, $inputString);

function applyMask($value, $mask) {
    $value = array_reverse(str_split(str_pad($value, 36, "0", STR_PAD_LEFT)));
    $mask = array_reverse(str_split($mask));

    foreach ($mask as $i => $x) {
        if ($x == '1') {
            $value[$i] = 1;
        } elseif ($x == 'X') {
            $value[$i] = 'X';
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

    $address = applyMask(decbin($address), $mask);
    $xs = array_filter(str_split($address), function ($a) {
        return $a == 'X';
    });
    $xis = array_keys($xs);

    $addresses = [];
    $max = bindec(str_repeat('1', count($xs)));
    for ($i = 0; $i <= $max; $i++) {
        $val = str_pad(decbin($i), count($xs), '0', STR_PAD_LEFT);

        $newAddress = $address;
        foreach (str_split($val) as $index => $oneOrZero) {
            $newAddress[$xis[$index]] = $oneOrZero;
        }

        $addresses[] = bindec($newAddress);
    }

    foreach ($addresses as $address) {
        $memory[$address] = $value;
    }
}

echo array_sum($memory) . PHP_EOL;
