<?php
function countIslands($image)
{
    for ($i = 0; $i < count($image); $i++) {
        echo "\"";
        for ($j = 0; $j < count($image[$i]); $j++) {
            if ($image[$i][$j] == "1") {
                echo "X";
            } else {
                echo "~";
            }
        }
        echo "\"";
        echo "<br>";
    }
}
$image = [
    [1, 1, 1, 1],
    [0, 1, 1, 0],
    [0, 1, 0, 1],
    [1, 1, 0, 0]
];

countIslands($image);
