<?php

function fizzbuzz(int $n) {
    for($i=1; $i<=$n; $i++) {
        $out = "";
        if($i % 3 == 0) { $out .= "Fizz"; }
        if($i % 5 == 0) { $out .= "Buzz"; }

        echo ($out !== "" ? $out : $i)."<br>";
    }
}

fizzbuzz(50);