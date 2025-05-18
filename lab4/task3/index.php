<?php

$numbers = [];

echo "Array: [";
for ($i = 0; $i < 100; $i++) {
    $numbers[] = mt_rand(1, 100);
    echo "$numbers[$i], ";
}
echo "]";