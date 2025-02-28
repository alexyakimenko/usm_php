<?php

$a = 0;
$b = 0;

for ($i = 0; $i <= 5; $i++) {
    echo "a = $a, b = $b \n";
    $a += 10;
    $b += 5;
}

echo "End of the loop: a = $a, b = $b \n";

$i = 0;
$a = 0;
$b = 0;

while ($i <= 5) {
    echo "a = $a, b = $b \n";
    $a += 10;
    $b += 5;
    $i++;
}

echo "End of the loop: a = $a, b = $b \n";

$i = 0;
$a = 0;
$b = 0;

do {
    echo "a = $a, b = $b \n";
    $a += 10;
    $b += 5;
    $i++;
} while ($i <= 5);

echo "End of the loop: a = $a, b = $b \n";