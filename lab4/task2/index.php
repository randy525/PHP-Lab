<?php

$a = 0;
$b = 0;
$i = 0;

while ($i <= 5) {
    echo "a = $a, b = $b<br/>";
    $a += 10;
    $b += 5;
    $i++;
}

echo "End of the loop: a = $a, b = $b";