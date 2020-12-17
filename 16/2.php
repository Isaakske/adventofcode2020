<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(PHP_EOL, $inputString);

$section = 0;
$rules = [];
$rulesPerSpaces = [];

foreach ($inputArray as $input) {
    if ($input == '') {
        $section++;
        continue;
    }

    if (preg_match('/^[a-z ]+:$/', $input)) {
        continue;
    }

    if (!$section) {
        preg_match('/([a-z ]+): (\d+)-(\d+) or (\d+)-(\d+)/', $input, $matches);
        $rules[$matches[1]] = array_merge(range($matches[2], $matches[3]), range($matches[4], $matches[5]));
        continue;
    }

    if ($section) {
        $numbers = explode(',', $input);

        if (!$rulesPerSpaces) {
            for ($i = 0; $i < count($numbers); $i++) {
                $rulesPerSpaces[$i] = array_keys($rules);
            }
        }

        $found = [];
        foreach ($numbers as $i => $number) {
            foreach ($rules as $j => $rule) {
                if (in_array($number, $rule)) {
                    $found[$i][] = $j;
                }
            }
        }

        if (!count($found)) {
            continue;
        }

        
    }
}


