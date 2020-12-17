<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(PHP_EOL, $inputString);

$section = 0;
$rules = [];
$errorRate = 0;

foreach ($inputArray as $input) {
    if ($input == '') {
        $section++;
        continue;
    }

    if (preg_match('/^[a-z ]+:$/', $input)) {
        continue;
    }

    if ($section == 0) {
        preg_match('/[a-z ]+: (\d+)-(\d+) or (\d+)-(\d+)/', $input, $matches);
        $rules[] = array_merge(range($matches[1], $matches[2]), range($matches[3], $matches[4]));
    }

    if ($section == 2) {
        foreach (explode(',', $input) as $number) {
            $found = false;

            foreach ($rules as $rule) {
                if (in_array($number, $rule)) {
                    $found = true;
                }
            }

            if (!$found) {
                $errorRate += $number;
            }
        }
    }
}

echo $errorRate . PHP_EOL;
