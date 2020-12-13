<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(PHP_EOL, $inputString);

$buses = array_filter(explode(',', $inputArray[1]), function ($b) {
    return $b != 'x';
});

$start = $buses[0];
$highest = $buses[$start];

$guaranteed = $start * $highest;

unset($buses[0]);
unset($buses[$start]);

$i = 100000000000000;
while ($i % $guaranteed) {
    $i++;
}

while (true) {
    foreach ($buses as $offset => $id) {
        if (($i + ($offset - $start)) % $id) {
            $i += $guaranteed;
            continue 2;
        }
    }

    break;
}

echo 'RESULT: ' . ($i - $start) . PHP_EOL;
