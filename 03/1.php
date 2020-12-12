<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = array_map(fn (string $row) => str_split($row), explode(PHP_EOL, $inputString));

$bottomRow = count($inputArray);
$trees = 0;
$x = 0;
$y = 0;

do {
    $currentRow = $inputArray[$y];
    $limit = count($currentRow) - 1;

    $x += 3;
    if ($x > $limit) {
        $x -= ($limit + 1);
    }

    $y++;

    if ($inputArray[$y][$x] == '#') {
        $trees++;
    }
} while ($y < $bottomRow);

echo $trees . PHP_EOL;
