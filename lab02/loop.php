<?php

const TOTAL = 100;
$price =  22;
$tenCoin = 0; $fiveCoin = 0; $oneCoin = 0;

$change = TOTAL - $price;
echo "Change is : $change <br>";

while( $change > 0) {

    if ($change > 10) {
        $change -= 10;
        $tenCoin++;

    } else if ($change > 5){
        $change -= 5;
        $fiveCoin++;
        
    } else {
        $oneCoin = $change;
        $change = 0;
    }
}

echo "Ten coin is : $tenCoin <br>";
echo "Five  coin is : $fiveCoin <br>";
echo "One  coin is : $oneCoin <br>";
