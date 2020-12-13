<?php

$inputString = file_get_contents(__DIR__ . '/input.txt');

$inputArray = explode(PHP_EOL, $inputString);

$timeStamp = $inputArray[0];
$buses = array_filter(explode(',', $inputArray[1]), function ($b) {
    return $b != 'x';
});

$away = [];
foreach ($buses as $bus) {
    $time = 0;
    while ($time < $timeStamp) {
        $time += $bus;
    }

    $away[$bus] = $time;
}

$min = min($away);
$id = array_search($min, $away);

echo $id * ($min - $timeStamp) . PHP_EOL;
