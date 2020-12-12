<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(PHP_EOL, $inputString);

$needle = 'shiny gold bag';
$bagMap = [];
$bagOptions = [];

foreach ($inputArray as $bag) {
    preg_match_all('/\d?[a-z\s]* bag/', $bag, $bags);
    $bags = $bags[0];

    [$definition] = array_splice($bags, 0, 1);

    $bagMap[$definition] = array_map(function ($b) {
        return preg_replace('/\d+\s/', '', $b);
    }, $bags);
}

function bagCanContainNeedle($needle, $bag, $bags, &$bagOptions, $bagMap) {
    if (in_array($needle, $bags)) {
        $bagOptions[] = $bag;
    }

    foreach ($bags as $b) {
        if (array_key_exists($b, $bagMap)) {
            bagCanContainNeedle($needle, $bag, $bagMap[$b], $bagOptions, $bagMap);
        }
    }
}

foreach ($bagMap as $bag => $bags) {
    bagCanContainNeedle($needle, $bag, $bags, $bagOptions, $bagMap);
}

echo count(array_unique($bagOptions)) . PHP_EOL;
