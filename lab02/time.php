<?php

const TOTAL_SECOND = 23760;

$hour = (int)(TOTAL_SECOND / 3600);

$cal = TOTAL_SECOND % 3600;
$minute = (int)($cal / 60);

$second = $cal % 60;

