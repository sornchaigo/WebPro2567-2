<?php

const TOTAL = 100;
$price =  22;

$change = TOTAL - $price;

$oneCoin = $change % 5;
$fiveCoin = (int)(($change % 10) / 5);
$tenCoin = (int)($change / 10);

echo "Change is : $change <br>";
echo "Ten coin is : $tenCoin <br>";
echo "Five  coin is : $fiveCoin <br>";
echo "One  coin is : $oneCoin <br>";