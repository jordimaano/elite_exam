<?php
function search($list, $target)
{
    $results = [];
    for ($i = 0; $i < count($list); $i++) {
        if ($list[$i] == $target) {
            array_push($results, $i);
        }
    }
    for ($i = 0; $i < count($results); $i++) {
        if (count($results) < 3) {
            echo "INDEX " . $results[0] . " and INDEX " . $results[1];
            break;
        }
        if ($i < count($results) - 1) {
            echo "INDEX " . $results[$i] . ", ";
        } else {
            echo "and INDEX " . $results[$i];
        }
    }
}

$list = ["I", "TWO", "FORTY", "THREE", "JEN", "TWO", "tWo", "Two"];
$target = "TWO";

search($list, $target);
