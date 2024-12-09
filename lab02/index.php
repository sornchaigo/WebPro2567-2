<?php

const TOTAL = 100;
$price =  22;

$change = TOTAL - $price;
echo "Change is : $change <br>";

$tenCoin = (int)($change / 10);

$change = $change % 10;
$fiveCoin = (int)($change / 5);

$oneCoin = $change % 5;

echo "Ten coin is : $tenCoin <br>";
echo "Five  coin is : $fiveCoin <br>";
echo "One  coin is : $oneCoin <br>";
