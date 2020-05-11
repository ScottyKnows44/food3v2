<?php

function validFood($food)
{
    $food = str_replace(' ', '', $food);
                                //alphabetical order
        return !empty($food) && ctype_alpha($food);
}
/*
echo validFood("french fries") ? "yes<br>" : "No<br>";
echo validFood("pizza") ? "yes<br>" : "No<br>";
echo validFood("7-layer dip") ? "yes<br>" : "No<br>";
echo validFood("") ? "yes<br>" : "No<br>";
*/