<?php

$inputString = require 'input.php';

$inputArray = explode(PHP_EOL, $inputString);

$inputArray = array_map(function ($row) {
    return str_split($row);
}, $inputArray);

function countOccupied($posX, $posY, $inputArray) {
    $result = 0;

    foreach ([-1, 0, 1] as $modX) {
        foreach ([-1, 0, 1] as $modY) {
            if (!$modX && !$modY) {
                continue;
            }

            $x = $posX + $modX;
            $y = $posY + $modY;

            while (
                array_key_exists($y, $inputArray)
                && array_key_exists($x, $inputArray[$y])
                && $inputArray[$y][$x] == '.'
            ) {
                $x += $modX;
                $y += $modY;
            }

            if (!array_key_exists($y, $inputArray) || !array_key_exists($x, $inputArray[$y])) {
                continue;
            }

            if ($inputArray[$y][$x] == '#') {
                $result++;
            }
        }
    }

    return $result;
}

do {
    $x = 0;
    $y = 0;

    $changeSet = [];
    foreach ($inputArray as $y => $row) {
        foreach ($row as $x => $position) {
            if ($position == 'L' && !countOccupied($x, $y, $inputArray)) {
                $changeSet[$y][$x] = '#';
            } elseif ($position == '#' && countOccupied($x, $y, $inputArray) >= 5) {
                $changeSet[$y][$x] = 'L';
            }
        }
    }

    foreach ($changeSet as $y => $row) {
        foreach ($row as $x => $position) {
            $inputArray[$y][$x] = $position;
        }
    }
} while (count($changeSet));

$resultString = implode("", array_map(fn ($row) => implode("", $row), $inputArray));

echo substr_count($resultString , '#') . PHP_EOL;
