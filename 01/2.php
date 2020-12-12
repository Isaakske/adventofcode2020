<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$input = explode(PHP_EOL, $inputString);

foreach ($input as $i) {
    foreach ($input as $j) {
        foreach ($input as $k) {
            if ($i + $j + $k == 2020 && $i != $j && $i != $k && $j != $k) {
                echo $i * $j * $k . PHP_EOL;
                return;
            }
        }
    }
}
