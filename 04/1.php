<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(PHP_EOL . PHP_EOL, $inputString);

$valid = 0;
foreach ($inputArray as $passport) {
    $fields = preg_split('/\s/', $passport);
    $requiredFields = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid', 'cid'];

    foreach ($fields as $data) {
        [$field,] = explode(':', $data);

        array_splice($requiredFields, array_search($field, $requiredFields), 1);
    }

    if (!count($requiredFields) || (count($requiredFields) === 1 && reset($requiredFields) === 'cid')) {
        $valid++;
    }
}

echo $valid . PHP_EOL;
