<?php

$inputString = require 'input.php';

$inputArray = explode(PHP_EOL, $inputString);

$needle = 'shiny gold bag';
$bagMap = [];

foreach ($inputArray as $bag) {
    preg_match_all('/\d?[a-z\s]* bag/', $bag, $bags);
    $bags = $bags[0];

    [$definition] = array_splice($bags, 0, 1);

    $bagMap[$definition] = $bags;
}

function countBagsInBag($needle, $bagMap) {
    if (!array_key_exists($needle, $bagMap)) {
        return 1;
    }

    return array_reduce($bagMap[$needle], function (int $carry, string $b) use ($bagMap) {
        preg_match('/\d+/', $b, $matches);
        $amount = $matches[0];
        $bag = preg_replace('/\d+\s/', '', $b);

        return $carry + ($amount * countBagsInBag($bag, $bagMap));
    }, 1);
}

echo countBagsInBag($needle, $bagMap) - 1 . PHP_EOL;
