<?php

$inputString = require 'input.php';

$inputArray = array_map(fn (string $row) => str_split($row), explode(PHP_EOL, $inputString));

$bottomRow = count($inputArray);

$trees = 1;
foreach ([[1, 1], [3, 1], [5, 1], [7, 1], [1, 2]] as [$movX, $movY]) {
    $treesForSlope = 0;

    $x = 0;
    $y = 0;

    do {
        $currentRow = $inputArray[$y];
        $limit = count($currentRow) - 1;

        $x += $movX;
        if ($x > $limit) {
            $x -= ($limit + 1);
        }

        $y += $movY;

        if ($inputArray[$y][$x] == '#') {
            $treesForSlope++;
        }
    } while ($y < $bottomRow);

    $trees *= $treesForSlope;
}

echo $trees . PHP_EOL;
