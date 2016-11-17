<?php

// output directory and file namming config.
$outputFolder = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "out" . DIRECTORY_SEPARATOR;
$fileNamePrefix = "test-";
$fileNameSuffix = time();

// open file handler but check the directory first.
if (is_writable($outputFolder)) {

    $fileHandler = fopen("{$outputFolder}{$fileNamePrefix}{$fileNameSuffix}.txt", 'a+');
} else {

    exit("{$outputFolder} Path is not writable. Please check permissions and try again");
}

// meant not to use microtime here
$startTime = time();
$endTime = 0;

// get the PHP's max execution time
$maximumExecution = (int)ini_get('max_execution_time');

$validTime = function () use ($startTime, $maximumExecution) {
    return (time() - $startTime) < ($maximumExecution - 1);
};

while ($validTime()) {

    // keep sleeping for a sec to work with time() function.
    sleep(1);
    fwrite($fileHandler, time() . "\n");
}

$endTime = time();

fwrite($fileHandler, "Execution Completed at {$endTime}, with " . ($endTime - $startTime) . " Seconds elapsed.");