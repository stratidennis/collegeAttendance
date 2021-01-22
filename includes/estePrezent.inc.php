<?php

function estePrezent($state)
{
    $today = getdate();
    $todayDate = $today["mday"] . $today["mon"] . $today["year"];
    $length = strlen($state);
    $number = 0;
    for ($i = 0; $i < $length; $i++) {
        while ($state[$i] != " ") {
            $number = $number * 10 + $state[$i];
            $i++;
        }
        if ($number == $todayDate) {
            return true;
        } else {
            $number = 0;
        }
    }
    if ($number == 0) {
        return false;
    }
}