<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(PHP_EOL, $inputString);

$preamble = 25;

for ($i = $preamble; $i < count($inputArray); $i++) {
    $currentNumber = $inputArray[$i];
    $numbers = array_slice($inputArray, $i - $preamble, $preamble);

    foreach ($numbers as $number1) {
        foreach ($numbers as $number2) {
            if (($number1 != $number2) && ($number1 + $number2 == $currentNumber)) {
                continue 3;
            }
        }
    }

    echo $currentNumber . PHP_EOL;
}
