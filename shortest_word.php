<?php

function shortestWord($sentence)
{
    $arr = explode(" ", $sentence);
    $shortest = 1000;
    for ($i = 0; $i < count($arr); $i++) {
        if (strlen($arr[$i]) < $shortest) {
            $shortest = strlen($arr[$i]);
        }
    }
    return $shortest;
}


$test_cases = ["TRUE FRIENDS ARE ME AND YOU", "I AM THE LEGENDARY VILLAIN"];
echo shortestWord($test_cases[0]);
echo "<br>";
echo shortestWord($test_cases[1]);
