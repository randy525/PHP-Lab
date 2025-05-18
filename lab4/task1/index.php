<?php

$a = 0;
$b = 0;

for ($i = 0; $i <= 5; $i++) {
    echo "a = $a, b = $b<br/>";
    $a += 10;
    $b += 5;
}

echo "End of the loop: a = $a, b = $b";