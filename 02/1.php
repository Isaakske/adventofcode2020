<?php

$inputString = require 'input.php';

$inputArray = explode(PHP_EOL, $inputString);

$valid = 0;

foreach ($inputArray as $i) {
    preg_match('/(\d*)-(\d*)\s([a-z]):\s([a-z]*)/', $i, $matches);

    $min = $matches[1];
    $max = $matches[2];
    $char = $matches[3];
    $pwd = $matches[4];

    $count = substr_count($pwd, $char);

    if ($count >= $min && $count <= $max) {
        $valid++;
    }
}

echo $valid . PHP_EOL;
