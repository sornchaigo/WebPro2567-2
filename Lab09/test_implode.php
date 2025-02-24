<?php


// $condition = [ 'menu_name like "b%"', 'price<10' ];
// echo implode(' AND ', $condition);

$query = http_build_query(['menu_name' => 'bread', 'price' => 8], '=', ',');
echo $query;