<?php
function pass_by_value( $arg ) {
    $arg = $arg + 10;
}

function pass_by_ref( &$arg ) {
    $arg = $arg + 10;
}

$myarg = 10;
echo "Before :". $myarg . "<br>";
pass_by_value($myarg);
echo "After :". $myarg . "<br>";

$myarg = 10;
echo "Before :". $myarg . "<br>";
pass_by_ref($myarg);
echo "After :". $myarg . "<br>";
