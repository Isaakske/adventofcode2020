<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(PHP_EOL . PHP_EOL, $inputString);

$valid = 0;
foreach ($inputArray as $passport) {
    $fields = preg_split('/\s/', $passport);
    $requiredFields = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid', 'cid'];

    foreach ($fields as $data) {
        [$field, $value] = explode(':', $data);

        if (isValid($field, $value)) {
            array_splice($requiredFields, array_search($field, $requiredFields), 1);
        }
    }

    if (!count($requiredFields) || (count($requiredFields) == 1 && reset($requiredFields) == 'cid')) {
        $valid++;
    }
}

echo $valid . PHP_EOL;

function isValid($field, $value) {
    switch ($field) {
        case 'byr': return $value >= 1920 && $value <= 2002;
        case 'iyr': return $value >= 2010 && $value <= 2020;
        case 'eyr': return $value >= 2020 && $value <= 2030;
        case 'hgt': {
            $end = substr($value, -2);
            $height = substr($value, 0, strlen($value) - 2);
            if ($end == 'cm') {
                return $height >= 150 && $height <= 193;
            }
            if ($end == 'in') {
                return $height >= 59 && $height <= 76;
            }
            return false;
        }
        case 'hcl': return preg_match('/^#[0-9a-f]{6}$/', $value);
        case 'ecl': return in_array($value, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth']);
        case 'pid': return preg_match('/^[0-9]{9}$/', $value);
        default: return true;
    }
}
