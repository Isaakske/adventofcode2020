<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(',', $inputString);

$i = -1;
$numbers = [];
while ($i < 2020) {
    $i++;

    if (array_key_exists($i, $inputArray)) {
        $numbers[] = $inputArray[$i];
        continue;
    }

    $last = end($numbers);
    if (count(array_filter($numbers, function ($n) use ($last) {
        return $n == $last;
    })) == 1) {
        $numbers[] = 0;
        continue;
    }

    $search = array_reverse($numbers);
    array_shift($search);

    $before = array_search($last, $search);
    $numbers[] = $before + 1;
}

echo $numbers[2019] . PHP_EOL;
