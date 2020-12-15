<?php

ini_set('memory_limit', '8192M');

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(',', $inputString);

$i = -1;
$last = null;
$lastOccurrence = [];
$count = [];
while ($i < 29999999) {
    $i++;

    if (array_key_exists($i, $inputArray)) {
        $number = $inputArray[$i];

        $last = $number;
        $lastOccurrence[$number] = [$i, $lastOccurrence[$number][0] ?? null];
        if (!array_key_exists($number, $count)) {
            $count[$number] = 0;
        }
        $count[$number]++;
        continue;
    }

    if ($count[$last] == 1) {
        $number = 0;

        $last = $number;
        $lastOccurrence[$number] = [$i, $lastOccurrence[$number][0] ?? null];
        if (!array_key_exists($number, $count)) {
            $count[$number] = 0;
        }
        $count[$number]++;
        continue;
    }

    $number = $i - ($lastOccurrence[$last][1] + 1);

    $last = $number;
    $lastOccurrence[$number] = [$i, $lastOccurrence[$number][0] ?? null];
    if (!array_key_exists($number, $count)) {
        $count[$number] = 0;
    }
    $count[$number]++;

    if ($i % 1000000 == 0) {
        echo 'looped over ' . $i . ' results' . PHP_EOL;
    }
}

echo $last . PHP_EOL;
