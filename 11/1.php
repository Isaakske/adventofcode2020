<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(PHP_EOL, $inputString);

$inputArray = array_map(function ($row) {
    return str_split($row);
}, $inputArray);

function countOccupied($posX, $posY, $inputArray) {
    $result = 0;

    foreach ([$posX - 1, $posX, $posX + 1] as $x) {
        foreach ([$posY - 1, $posY, $posY + 1] as $y) {
            if ($x == $posX && $y == $posY) {
                continue;
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
            } elseif ($position == '#' && countOccupied($x, $y, $inputArray) >= 4) {
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
