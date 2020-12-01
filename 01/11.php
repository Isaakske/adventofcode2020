<?php

$inputString = require 'input.php';

$input = explode(PHP_EOL, $inputString);

foreach ($input as $i) {
    foreach ($input as $j) {
        if ($i + $j == 2020 && $i != $j) {
            echo $i * $j . PHP_EOL;
            return;
        }
    }
}
